<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 17:32
 */

namespace App\AppBundle\Managers;

use App\AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use App\AppBundle\Entity\Interfaces\ProductCategoryInterface;
use App\AppBundle\Entity\Interfaces\ProductInterface;
use App\AppBundle\Entity\ProductCategory;
use App\AppBundle\Managers\Traits\PagerfantaBuilderTrait;
use App\AppBundle\Model\Filter\FilterAttr;
use App\AppBundle\Model\Filter\FilterAttrInterface;
use App\AppBundle\Model\Filter\FilterAttrValue;
use App\AppBundle\Model\Filter\FilterInterface;
use App\AppBundle\Model\Types\Range\FloatRange;
use App\AppBundle\Model\Types\Range\RangeInterface;
use App\AppBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;
use App\AppBundle\Entity\ProductAttrValue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use App\AppBundle\Form\Filter\FilterType;

/**
 * ProductManager
 */
class ProductManager extends EntityManager
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

    /* @var ProductCategoryInterface */
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
     * @param ProductCategoryInterface|null $productCategory
     * @return ProductManager
     */
    public function setProductCategory(?ProductCategoryInterface $productCategory): ProductManager
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @return ProductCategoryInterface|null
     */
    public function getProductCategory(): ?ProductCategoryInterface
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

            /* @var ProductCategoryInterface[] $productCategoryArr*/
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
     * @return ProductInterface|null
     */
    public function getById(int $id): ?ProductInterface
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

        return new FloatRange($resultArr['min_price'] ?: 0.00, $resultArr['max_price'] ?: 0.00);
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
                    /* @var FilterAttrInterface $filterAttr */
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
        /* @var ProductAttrValueInterface[] $attrValueArr */
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

    /**
     * insert or update
     *
     * @param ProductInterface $product
     * @param bool             $andFlush
     *
     * @throws OptimisticLockException If a version check on an entity that
     *         makes use of optimistic locking fails.
     * @throws ORMInvalidArgumentException
     */
    public function save(ProductInterface $product, bool $andFlush = true): void
    {
        if($product->getId()) {
            $this->getEntityManager()->merge($product);
        } else {
            $this->getEntityManager()->persist($product);
        }

        if($andFlush) {
            $this->flush();
        }
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @return ProductInterface
     */
    public function createProduct(): ProductInterface
    {
        $class = $this->getClass();

        return new $class;
    }
}