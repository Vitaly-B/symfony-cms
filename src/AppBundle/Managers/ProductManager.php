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
use AppBundle\Managers\Traits\EntityManagerTrait;
use AppBundle\Managers\Traits\PagerfantaBuilderTrait;
use AppBundle\Model\Filter\FilterAttr;
use AppBundle\Model\Filter\FilterInterface;
use AppBundle\Model\Types\Range;
use AppBundle\Model\Types\RangeInterface;
use AppBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;

/**
 * ProductManager
 */
final class ProductManager
{
    use PagerfantaBuilderTrait;
    use EntityManagerTrait;
    /**
     * @var int
     */
    private $maxPerPage;

    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /* @var ProductCategory */
    private $productCategory;

    /* @var Filter */
    private $filter;


    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     * @param ProductCategoryManager $productCategoryManager
     * @param int                    $maxPerPage
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        string $class,
        ProductCategoryManager $productCategoryManager,
        int $maxPerPage = 10
    )
    {
        $this->entityManager          = $entityManager;
        $this->class                  = $class;
        $this->productCategoryManager = $productCategoryManager;
        $this->maxPerPage             = $maxPerPage;
    }

    /**
     * @param FilterInterface $filter
     * @return ProductManager
     */
    public function setFilter(FilterInterface $filter): ProductManager
    {
        $this->filter = $filter;

        return $this;
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

            array_walk($productCategoryArr, function(ProductCategory $productCategory) use(&$categoryIds) {
                $categoryIds[] = $productCategory->getId();
            });
        }

        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->getRepository()->createQueryBuilder('product');
        $queryBuilder->select('product')
            ->andWhere($queryBuilder->expr()->eq('product.enabled', true))
        ;

        if(!empty($categoryIds)) {
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
            foreach ($this->filter->getAttributes() as $key => $filterAttr) {
                if($filterAttr->isActive()) {
                    /* @var FilterAttr $filterAttr */
                    if ($key == 'price') {
                        ['min' => $filterAttrValueMin, 'max' => $filterAttrValueMax] = $filterAttr->getValues()->toArray();
                        $queryBuilder->andWhere($queryBuilder->expr()->between(
                            'product.price',
                            floatval(str_replace(',', '.',$filterAttrValueMin->getValue())),
                            floatval(str_replace(',', '.',$filterAttrValueMax->getValue()))
                        ));
                    }
                }
            }
        }
    }

}