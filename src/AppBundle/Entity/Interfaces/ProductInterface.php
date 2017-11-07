<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 12:03
 */

namespace App\AppBundle\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * ProductInterface
 */
interface ProductInterface extends PageInterface, PreviewableInterface,
    GalleryInterface
{
    /**
     * @param Collection|ProductCategoryInterface[] $categories
     *
     * @return ProductInterface
     */
    public function setCategories(Collection $categories): ProductInterface;

    /**
     * @return Collection|ProductCategoryInterface[]
     */
    public function getCategories(): Collection;

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function addCategory(ProductCategoryInterface $category): bool;

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function removeCategory(ProductCategoryInterface $category): bool;

    /**
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * @param float|null $price
     *
     * @return ProductInterface
     */
    public function setPrice(?float $price): ProductInterface;

    /**
     * @param Collection|ProductAttrValueInterface[] $attrValues
     *
     * @return ProductInterface
     */
    public function setAttrValues(Collection $attrValues): ProductInterface;

    /**
     * @return Collection|ProductAttrValueInterface[]
     */
    public function getAttrValues(): Collection;

    /**
     * @param ProductAttrValueInterface $attrValue
     *
     * @return bool
     */
    public function addAttrValue(ProductAttrValueInterface $attrValue): bool;

    /**
     * @param ProductAttrValueInterface $attrValue
     *
     * @return bool
     */
    public function removeAttrValue(ProductAttrValueInterface $attrValue): bool;
}