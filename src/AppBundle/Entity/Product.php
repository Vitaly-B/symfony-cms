<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 18:33
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\GalleryInterface;
use AppBundle\Entity\Interfaces\PreviewableInterface;
use AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use AppBundle\Entity\Interfaces\PageInterface;
use AppBundle\Entity\Interfaces\SeoInterface;
use AppBundle\Entity\Interfaces\SortableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Product
 */
class Product implements ProductInterface,
    SeoInterface,
    PreviewableInterface,
    GalleryInterface,
    SortableInterface
{
    use Traits\SeoTrait;
    use Traits\TimestampableTrait;
    use Traits\EnabledTrait;
    use Traits\PreviewableTrait;
    use Traits\GalleryTrait;
    use Traits\SortableTrait;

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