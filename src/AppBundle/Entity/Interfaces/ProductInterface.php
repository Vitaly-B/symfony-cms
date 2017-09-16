<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 13.09.2017
 * Time: 3:56
 */

namespace AppBundle\Entity\Interfaces;

use AppBundle\Entity\ProductAttrValue;
use AppBundle\Entity\ProductCategory;
use Doctrine\Common\Collections\Collection;

/**
 * ProductInterface
 */
interface ProductInterface extends PageInterface,
    PreviewableInterface,
    GalleryInterface
{
    /**
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     * @return ProductInterface
     */
    public function setPosition(?int $position): ProductInterface;

    /**
     * @param float $price
     *
     * @return ProductInterface
     */
    public function setPrice(?float $price): ProductInterface;

    /**
     * @param Collection $categories
     *
     * @return ProductInterface
     */
    public function setCategories(Collection $categories): ProductInterface;

    /**
     * @return Collection
     */
    public function getCategories(): Collection;

    /**
     * @param ProductCategory $category
     *
     * @return bool
     */
    public function addCategory(ProductCategoryInterface $category): bool;

    /**
     * @param ProductCategory $category
     *
     * @return bool
     */
    public function removeCategory(ProductCategoryInterface $category): bool;

    /**
     * @param Collection $attrValues
     *
     * @return ProductInterface
     */
    public function setAttrValues(Collection $attrValues): ProductInterface;

    /**
     * @return Collection
     */
    public function getAttrValues(): Collection;

    /**
     * @param ProductAttrValue $attrValue
     *
     * @return bool
     */
    public function addAttrValue(ProductAttrValue $attrValue): bool;

    /**
     * @param ProductAttrValue $attrValue
     *
     * @return bool
     */
    public function removeAttrValue(ProductAttrValue $attrValue): bool;

}