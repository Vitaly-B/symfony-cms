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
class ProductCategoryManager
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
     * @param int|null $categoryId
     *
     * @return array|ProductCategory[]
     */
    public function getCategoryHierarchy(?int $categoryId = null): array
    {
        /* @var ProductCategoryRepository $repository */
        $repository = $this->getRepository();

        return $repository->getNodesHierarchyQuery($categoryId ? $repository->find($categoryId) : null)->getResult();
    }

}