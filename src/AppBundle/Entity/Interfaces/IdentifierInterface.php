<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:15
 */

namespace AppBundle\Entity\Interfaces;

/**
 * IdentifierInterface
 */
interface IdentifierInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int;
}