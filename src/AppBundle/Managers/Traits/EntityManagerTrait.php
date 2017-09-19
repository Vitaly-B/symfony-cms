<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 11:46
 */

namespace AppBundle\Managers\Traits;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

trait EntityManagerTrait
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $class;

    /* @var ObjectRepository */
    protected $_repository;

    /**
     * @return EntityManagerInterface
     */
    public function  getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository()
    {
        if($this->_repository === null) {
            $this->_repository = $this->getEntityManager()->getRepository($this->getClass());
        }

        return $this->_repository;
    }
}