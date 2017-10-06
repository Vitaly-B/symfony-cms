<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 17:32
 */

namespace AppBundle\Managers;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
use AppBundle\Managers\Traits\PagerfantaBuilderTrait;
use AppBundle\Model\Filter\FilterAttr;
use AppBundle\Model\Filter\FilterAttrValue;
use AppBundle\Model\Filter\FilterInterface;
use AppBundle\Model\Types\Range;
use AppBundle\Model\Types\RangeInterface;
use AppBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;
use Psr\Container\ContainerInterface;
use AppBundle\Entity\ProductAttrValue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use AppBundle\Form\Filter\FilterType;

/**
 * ProductManager
 */
final class ProductManager extends EntityManager
{
    use PagerfantaBuilderTrait;

    /**
     * @var int
     */
    private $maxPerPage;

    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /* @var ProductAttrValueManager */
    private $productAttrValueManager;

    /* @var ProductCategory */
    private $productCategory;

    /* @var FilterInterface */
    private $filter;

    /* @var bool */
    private $isInitializeFilter = false;

    /* @var FormFactoryInterface*/
    private $formFactory;

    /* @var FormInterface*/
    private $filterForm;

    /**
     * @param EntityManagerInterface  $entityManager
     * @param string                  $class
     * @param ProductCategoryManager  $productCategoryManager
     * @param ProductAttrValueManager $productAttrValueManager
     * @param FilterInterface         $filter
     * @param FormFactoryInterface    $formFactory
     * @param int                     $maxPerPage
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        string $class,
        ProductCategoryManager $productCategoryManager,
        ProductAttrValueManager $productAttrValueManager,
        FilterInterface $filter,
        FormFactoryInterface $formFactory,
        int $maxPerPage = 10
    )
    {
        parent::__construct($entityManager, $class);
        $this->productCategoryManager  = $productCategoryManager;
        $this->productAttrValueManager = $productAttrValueManager;
        $this->filter                  = $filter;
        $this->formFactory             = $formFactory;
        $this->maxPerPage              = $maxPerPage;
    }

    /**
     * @return FilterInterface|null
     */
    public function getFilter(): ?FilterInterface
    {
        return $this->filter;
    }

    /**
     * @param ProductCategory|null $productCategory
     * @return ProductManager
     */
    public function setProductCategory(?ProductCategory $productCategory): ProductManager
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @return ProductCategory|null
     */
    public function getProductCategory(): ?ProductCategory
    {
        return $this->productCategory;
    }

    /**
     * @return int
     */
    public function getMaxPerPage(): int
    {
        return $this->maxPerPage;
    }

    /**
     * @param int $maxPerPage
     * @return ProductManager
     */
    public function setMaxPerPage(int $maxPerPage): ProductManager
    {
        $this->maxPerPage = $maxPerPage;

        return $this;
    }

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function getProducts(int $page = 1): Pagerfanta
    {
        /* @var ProductRepository $repository */
        $repository = $this->getRepository();

        /* @var int[] $categoryIds */
        $categoryIds = [];

        if($this->productCategory) {

            $categoryIds[] = $this->productCategory->getId();

            /* @var ProductCategory[] $productCategoryArr*/
            $productCategoryArr = $this->productCategoryManager->getCategoryHierarchy($this->productCategory);

            $categoryIds = array_map(function(ProductCategory $productCategory) {
                return $productCategory->getId();
            }, $productCategoryArr);
        }

        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->getRepository()->createQueryBuilder('product');
        $queryBuilder->select('product')
            ->andWhere($queryBuilder->expr()->eq('product.enabled', true))
        ;

        if(!empty($categoryIds)) {
            $queryBuilder->addSelect('categories');
            $queryBuilder->join('product.categories', 'categories')
                ->andWhere($queryBuilder->expr()->in('categories.id', $categoryIds));
        }

        $this->applyFilter($queryBuilder);

        $queryBuilder->orderBy('product.position', 'DESC');

        return $this->getPaginator($queryBuilder->getQuery(), $page, $this->getMaxPerPage());
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function getById(int $id): ?Product
    {
        /* @var ProductRepository $repository */
        $repository = $this->getRepository();

        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->createQueryBuilder('product');
        $queryBuilder->where($queryBuilder->expr()->andX(
            $queryBuilder->expr()->eq('product.id', $id),
            $queryBuilder->expr()->eq('product.enabled', true)
        ));

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return RangeInterface
     */
    public function getMinAndMaxPrice(): RangeInterface
    {
        /* @var ProductRepository $repository */
        $repository = $this->getRepository();

        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->createQueryBuilder('product');
        $queryBuilder->select('MIN(product.price) as min_price, MAX(product.price) as max_price');
        /* @var array $resultArr */
        $resultArr = $queryBuilder->getQuery()->getSingleResult(Query::HYDRATE_SCALAR);

        return new Range($resultArr['min_price'], $resultArr['max_price']);
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return void
     */
    private function applyFilter(QueryBuilder $queryBuilder)
    {

        if($this->filter && $this->filter->isActive()) {

            $attrIdsArr    = [];
            $attrValuesArr = [];

            foreach ($this->filter->getAttributes() as $filterAttr) {
                if($filterAttr->isActive()) {
                    /* @var FilterAttr $filterAttr */
                    if ($filterAttr->getKey() == 'price') {
                        ['min' => $filterAttrValueMin, 'max' => $filterAttrValueMax] = $filterAttr->getValues()->toArray();
                        $queryBuilder->andWhere($queryBuilder->expr()->between(
                            'product.price',
                            floatval(str_replace(',', '.', $filterAttrValueMin->getValue())),
                            floatval(str_replace(',', '.', $filterAttrValueMax->getValue()))
                        ));
                    } else {
                        //filter by attributes
                        if(!$filterAttr->getValues()->isEmpty()) {
                            $attrIdsArr[] = (int) $filterAttr->getKey();
                            foreach ($filterAttr->getValues() as $attrValue) {
                                /* @var FilterAttrValue $attrValue */
                                if($attrValue->isActive()) {
                                    $attrValuesArr[] = $attrValue->getValue();
                                }
                            }
                        }
                    }
                }
            }

            if(!empty($attrIdsArr)) {
                $queryBuilder->leftJoin('product.attrValues', 'attrValues');
                $queryBuilder->andWhere($queryBuilder->expr()->andX($queryBuilder->expr()->in('attrValues.attributeId', $attrIdsArr),
                        $queryBuilder->expr()->in('attrValues.value', $attrValuesArr)
                    )
                );
            }

        }
    }

    /**
     * @return ProductManager
     */
    public function initializeFilter(): ProductManager
    {
        /* @var ProductAttrValue[] $attrValueArr */
        $attrValueArr = $this->productAttrValueManager->getUniqueValuesByCategory($this->getProductCategory());

        array_walk($attrValueArr, function(ProductAttrValue $attrValue) {
            if(!$this->filter->hasAttribute($attrValue->getAttribute()->getId())) {
                $attribute = new FilterAttr($attrValue->getAttribute()->getId(),$attrValue->getAttribute()->getTitle(), $this->filter, CheckboxType::class);
                $this->filter->addAttribute($attribute);
            } else {
                $attribute = $this->filter->getAttribute($attrValue->getAttribute()->getId());
            }
            $attribute->addValue(new FilterAttrValue($attrValue->getId(), $attrValue->getValue(), $attribute, $attrValue->getValue()));
        });

        //Add price filter
        /* @var RangeInterface $priceRange */
        $priceRange = $this->getMinAndMaxPrice();

        $attributePrice = new FilterAttr('price', 'Price', $this->filter,TextType::class);
        $attributePrice->addValue(new FilterAttrValue('min', $priceRange->getMin(), $attributePrice, 'Min'));
        $attributePrice->addValue(new FilterAttrValue('max', $priceRange->getMax(), $attributePrice, 'Max'));

        $this->filter->addAttribute($attributePrice);

        $this->isInitializeFilter = true;

        return $this;
    }

    /**
     * @return FormInterface
     */
    public function getFilterForm(): FormInterface
    {
        if(!$this->isInitializeFilter) {
            $this->initializeFilter();
        }

        if($this->filterForm === null) {
            $this->filterForm = $this->formFactory->create(FilterType::class, $this->filter);
        }

        return $this->filterForm;
    }
}