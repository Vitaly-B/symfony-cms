<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 11:15
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductCategory;
use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Repository\ProductCategoryRepository;

/**
 * ProductCategoryManager
 */
class ProductCategoryManager extends EntityManager
{
    /**
     * @param int $id
     * @return ProductCategoryInterface|null
     */
    public function getById(int $id): ?ProductCategoryInterface
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param ProductCategoryInterface|null $currentCategory
     *
     * @return ProductCategoryInterface[]
     */
    public function getCategoryHierarchy(?ProductCategoryInterface $currentCategory = null): array
    {
        /* @var ProductCategoryRepository $repository */
        $repository = $this->getRepository();

        return $repository->getNodesHierarchyQueryBuilder($currentCategory)->getQuery()->getResult();
    }

    /**
     * @param ProductCategoryInterface|null $category
     *
     * @return int[]
     */
    public function getChildrenIds(?ProductCategoryInterface $category = null): array
    {
        /* @var ProductCategoryRepository $repository */
        $repository = $this->getRepository();

        /* @var ProductCategory[] $productCategoryArr */
        $productCategoryArr = $repository->getNodesHierarchyQuery($category)->getResult();

        return array_map(function(ProductCategoryInterface $productCategory) {
            return $productCategory->getId();
        }, $productCategoryArr);
    }

    /**
     * insert or update
     *
     * @param ProductCategoryInterface $productCategory
     * @param bool                     $andFlush
     *
     * @throws OptimisticLockException If a version check on an entity that
     *         makes use of optimistic locking fails.
     * @throws ORMInvalidArgumentException
     */
    public function save(ProductCategoryInterface $productCategory, bool $andFlush = true): void
    {
        if($productCategory->getId()) {
            $this->getEntityManager()->merge($productCategory);
        } else {
            $this->getEntityManager()->persist($productCategory);
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
     * @return ProductCategoryInterface
     */
    public function createProductCategory(): ProductCategoryInterface
    {
        $class = $this->getClass();

        return new $class;
    }
}