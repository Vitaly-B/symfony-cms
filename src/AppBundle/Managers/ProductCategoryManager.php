<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 11:15
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductCategory;
use AppBundle\Repository\ProductCategoryRepository;

/**
 * ProductCategoryManager
 */
final class ProductCategoryManager extends EntityManager
{
    /**
     * @param int $id
     * @return ProductCategory|null
     */
    public function getById(int $id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param ProductCategory|null $currentCategory
     *
     * @return ProductCategory[]
     */
    public function getCategoryHierarchy(?ProductCategory $currentCategory = null): array
    {
        /* @var ProductCategoryRepository $repository */
        $repository = $this->getRepository();

        return $repository->getNodesHierarchyQueryBuilder($currentCategory)->getQuery()->getResult();
    }

    /**
     * @param ProductCategory|null $category
     *
     * @return int[]
     */
    public function getChildrenIds(?ProductCategory $category = null): array
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