<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 17:32
 */

namespace AppBundle\Managers;

use AppBundle\Managers\Traits\PagerfantaBuilderTrait;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Pagerfanta;

/**
 * ProductManager
 */
class ProductManager
{
    use PagerfantaBuilderTrait;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var string
     */
    private $class;

    /**
     * @var int
     */
    private $maxPerPage;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     * @param int                    $maxPerPage
     */
    public function __construct(EntityManagerInterface $entityManager,
        string $class,
        int $maxPerPage = 10)
    {
        $this->entityManager = $entityManager;
        $this->class         = $class;
        $this->maxPerPage    = $maxPerPage;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return EntityManagerInterface
     */
    public function  getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
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

}