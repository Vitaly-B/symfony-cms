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
final class ProductCategoryManager extends EntityManager
{
    /**
     * @param int $id
     * @return ProductCategoryInterface|null
     */
    public function getById(int $id): ProductCategoryInterface
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

        return array_map(function(ProductCategory $productCategory) {
            return $productCategory->getId();
        }, $productCategoryArr);
    }

}