<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 18:33
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Product
 */
class Product
{
    use Traits\IdentifierTrait;
    use Traits\PageTrait;
    use Traits\SeoTrait;
    use Traits\TimestampableTrait;
    use Traits\EnabledTrait;
    use Traits\PreviewableTrait;
    use Traits\GalleryTrait;
    use Traits\SortableTrait;

    /* @var float */
    private $price;

    /* @var Collection */
    private $categories;

    /* @var Collection */
    private $attrValues;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->attrValues = new ArrayCollection();
    }

    /**
     * @param Collection|ProductCategory[] $categories
     *
     * @return Product
     */
    public function setCategories(Collection $categories): Product
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|ProductCategory[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param ProductCategory $category
     *
     * @return bool
     */
    public function addCategory(ProductCategory $category): bool
    {
        if(!$this->categories->contains($category)) {
            return $this->categories->add($category);
        }

        return false;
    }

    /**
     * @param ProductCategory $category
     *
     * @return bool
     */
    public function removeCategory(ProductCategory $category): bool
    {
        return $this->categories->removeElement($category);
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     *
     * @return Product
     */
    public function setPrice(?float $price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param Collection|ProductAttrValue[] $attrValues
     *
     * @return Product
     */
    public function setAttrValues(Collection $attrValues): Product
    {
        $this->attrValues = $attrValues;
        return $this;
    }

    /**
     * @return Collection|ProductAttrValue[]
     */
    public function getAttrValues(): Collection
    {
        return $this->attrValues;
    }

    /**
     * @param ProductAttrValue $attrValue
     *
     * @return bool
     */
    public function addAttrValue(ProductAttrValue $attrValue): bool
    {
        if (!$this->attrValues->contains($attrValue)) {
            return $this->attrValues->add($attrValue);
        }
        return false;
    }

    /**
     * @param ProductAttrValue $attrValue
     *
     * @return bool
     */
    public function removeAttrValue(ProductAttrValue $attrValue): bool
    {
        return $this->attrValues->removeElement($attrValue);
    }

    /**
     * @return string
     */
    function __toString(): string
    {
        return (string)$this->getId().':'.$this->getTitle();
    }
}