<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 11:15
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductCategory;
use AppBundle\Managers\Traits\EntityManagerTrait;
use AppBundle\Repository\ProductCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * ProductCategoryManager
 */
final class ProductCategoryManager
{
    use EntityManagerTrait;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string $class
     */
    public function __construct(EntityManagerInterface $entityManager, string $class)
    {
        $this->entityManager = $entityManager;
        $this->class         = $class;
    }

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

        $ids = [];

        array_walk($productCategoryArr,
            function (ProductCategory $productCategory) use(&$ids){
                $ids[] = $productCategory->getId();
            }
        );

        return $ids;
    }

}