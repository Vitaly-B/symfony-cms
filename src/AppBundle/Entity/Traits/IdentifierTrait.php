<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 23:33
 */

namespace AppBundle\Entity\Traits;


trait IdentifierTrait
{
    /* @var int */
    private $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}