<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 18:33
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use AppBundle\Entity\Interfaces\SortableInterface;
use AppBundle\Entity\Interfaces\TimestampableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Product
 */
class Product implements SortableInterface, ProductInterface, TimestampableInterface
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
     * @param Collection|ProductCategoryInterface[] $categories
     *
     * @return ProductInterface
     */
    public function setCategories(Collection $categories): ProductInterface
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|ProductCategoryInterface[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function addCategory(ProductCategoryInterface $category): bool
    {
        if(!$this->categories->contains($category)) {
            return $this->categories->add($category);
        }

        return false;
    }

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function removeCategory(ProductCategoryInterface $category): bool
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
     * @return ProductInterface
     */
    public function setPrice(?float $price): ProductInterface
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param Collection|ProductAttrValueInterface[] $attrValues
     *
     * @return ProductInterface
     */
    public function setAttrValues(Collection $attrValues): ProductInterface
    {
        $this->attrValues = $attrValues;
        return $this;
    }

    /**
     * @return Collection|ProductAttrValueInterface[]
     */
    public function getAttrValues(): Collection
    {
        return $this->attrValues;
    }

    /**
     * @param ProductAttrValueInterface $attrValue
     *
     * @return bool
     */
    public function addAttrValue(ProductAttrValueInterface $attrValue): bool
    {
        if (!$this->attrValues->contains($attrValue)) {
            return $this->attrValues->add($attrValue);
        }
        return false;
    }

    /**
     * @param ProductAttrValueInterface $attrValue
     *
     * @return bool
     */
    public function removeAttrValue(ProductAttrValueInterface $attrValue): bool
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