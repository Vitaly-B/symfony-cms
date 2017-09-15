<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 18:33
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\ProductInterface;
use AppBundle\Entity\Interfaces\PageInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Product
 */
class Product implements ProductInterface,
    Interfaces\TimestampableInterface,
    Interfaces\EnabledInterface,
    Interfaces\PreviewableInterface,
    Interfaces\GalleryInterface
{
    use Traits\SeoTrait;
    use Traits\TimestampableTrait;
    use Traits\EnabledTrait;
    use Traits\PreviewableTrait;
    use Traits\GalleryTrait;

    /* @var int */
    private $id;

    /* @var string */
    private $title;

    /* @var string */
    private $description;

    /* @var string */
    private $content;

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
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return PageInterface
     */
    public function setTitle(?string $title): PageInterface
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PageInterface
     */
    public function setDescription(?string $description): PageInterface
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return PageInterface
     */
    public function setContent(?string $content): PageInterface
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param Collection $categories
     *
     * @return ProductInterface
     */
    public function setCategories(Collection $categories): ProductInterface
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection
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
     * @return ProductInterface
     */
    public function setPrice(?float $price): ProductInterface
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param Collection $attrValues
     *
     * @return ProductInterface
     */
    public function setAttrValues(Collection $attrValues): ProductInterface
    {
        $this->attrValues = $attrValues;
        return $this;
    }

    /**
     * @return Collection
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