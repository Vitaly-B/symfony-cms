<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 05.10.2017
 * Time: 1:32
 */

namespace AppBundle\Managers;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * EntityManager
 */
class EntityManager
{
    /**
     * @var string
     */
    protected $class;

    /* @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     * @param string class
     */
    public function __construct(ContainerInterface $container, $class)
    {
        $this->container = $container;
        $this->class     = $class;
    }

    /**
     * @return EntityManagerInterface
     */
    public function  getEntityManager(): EntityManagerInterface
    {
        return $this->container->get('doctrine')->getManagerForClass($this->getClass());
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
    public function getRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository($this->getClass());
    }
}