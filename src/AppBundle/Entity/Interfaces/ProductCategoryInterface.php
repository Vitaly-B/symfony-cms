<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 14:00
 */

namespace AppBundle\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * ProductCategoryInterface
 */
interface ProductCategoryInterface extends CategoryInterface
{
    /**
     * @return Collection;
     */
    public function getProducts(): Collection;

    /**
     * @param Collection $products
     *
     * @return ProductCategoryInterface;
     */
    public function setProducts(Collection $products): ProductCategoryInterface;

    /**
     * @param ProductInterface $product
     *
     * @return bool
     */
    public function addProduct(ProductInterface $product): bool;

    /**
     * @param ProductInterface $product
     *
     * @return bool
     */
    public function removeProduct(ProductInterface $product): bool;
}