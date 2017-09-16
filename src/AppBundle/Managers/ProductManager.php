<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 17:32
 */

namespace AppBundle\Managers;


use AppBundle\Entity\Interfaces as EntityInterfaces;
use Doctrine\Common\Persistence\ObjectManager;
use Pagerfanta\Pagerfanta;

class ProductManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var string
     */
    private $class;

    /**
     * @param ObjectManager $objectManager
     * @param string $class
     */
    public function __construct(ObjectManager $objectManager, string $class)
    {
        $this->objectManager = $objectManager;
        $this->class         = $class;
    }


}