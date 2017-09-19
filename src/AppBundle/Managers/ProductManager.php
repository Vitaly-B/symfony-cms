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
use AppBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;

/**
 * ProductManager
 */
class ProductManager
{
    use PagerfantaBuilderTrait;
    use EntityManagerTrait;
    /**
     * @var int
     */
    private $maxPerPage;

    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     * @param int                    $maxPerPage
     * @param ProductCategoryManager $productCategoryManager
     */
    public function __construct(EntityManagerInterface $entityManager, string $class, int $maxPerPage = 10, ProductCategoryManager $productCategoryManager)
    {
        $this->entityManager          = $entityManager;
        $this->class                  = $class;
        $this->maxPerPage             = $maxPerPage;
        $this->productCategoryManager = $productCategoryManager;
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
     * @param ProductCategory|null  $category
     *
     * @return Pagerfanta
     */
    public function getProducts(int $page = 1, ?ProductCategory $category = null): Pagerfanta
    {
        /* @var ProductRepository $repository */
        $repository = $this->getRepository();

        /* @var int[] $categoryIds */
        $categoryIds = [];

        if($category) {

            $categoryIds[] = $category->getId();

            /* @var ProductCategory[] $productCategoryArr*/
            $productCategoryArr = $this->productCategoryManager->getCategoryHierarchy($category);

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



}