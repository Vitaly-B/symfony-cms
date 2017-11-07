<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:59
 */

namespace App\AppBundle\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * ProductCategoryInterface
 */
interface ProductCategoryInterface extends IdentifierInterface, NestedSetInterface
{
    /**
     * Set title
     *
     * @param string $title
     *
     * @return ProductCategoryInterface
     */
    public function setTitle(?string $title): ProductCategoryInterface;

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * @param  string $repeatStr
     *
     * @return string
     */
    public function getTitleLeveling(string $repeatStr = '-'): ?string;

    /**
     * @return Collection|ProductInterface[]
     */
    public function getProducts(): Collection;

    /**
     * @param Collection|ProductInterface[] $products
     *
     * @return ProductCategoryInterface
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