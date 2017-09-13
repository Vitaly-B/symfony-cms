<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 13.09.2017
 * Time: 3:56
 */

namespace AppBundle\Entity\Interfaces;

/**
 * ProductInterface
 */
interface ProductInterface extends PageInterface
{
    /**
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * @param float $price
     *
     * @return ProductInterface
     */
    public function setPrice(float $price): ProductInterface;
}