<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 17:32
 */

namespace AppBundle\Managers;

use AppBundle\Entity\Product;
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

    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     * @param int                    $maxPerPage
     */
    public function __construct(EntityManagerInterface $entityManager, string $class, int $maxPerPage = 10)
    {
        $this->entityManager = $entityManager;
        $this->class         = $class;
        $this->maxPerPage    = $maxPerPage;
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
     * @param int[] $productCategoryIds
     *
     * @return Pagerfanta
     */
    public function getPage(int $page = 1, array $productCategoryIds): Pagerfanta
    {
        /* @var ProductRepository $repository */
        $repository = $this->getRepository();

        /* @var QueryBuilder $queryBuilder*/
        $queryBuilder = $repository->getQueryBuilderByCategories($productCategoryIds);

        return $this->getPaginator($queryBuilder->getQuery(), $page, $this->getMaxPerPage());
    }

    public function getById(int $id): ?Product
    {
        /* @var ProductRepository $repository */
        $repository = $this->getRepository();
        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->getQueryBuilderById($id);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }



}