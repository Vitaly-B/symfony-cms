<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 23:33
 */

namespace App\AppBundle\Entity\Traits;


trait IdentifierTrait
{
    /* @var int */
    protected $id;

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