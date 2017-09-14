<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * CatalogAttr
 */
class ProductAttr
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Collection
     */
    private $categories;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return CatalogAttr
     */
    public function setTitle(?string $title): ProductAttr
    {
        $this->title = $title;

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
     * @param Collection $categories
     *
     * @return CatalogAttr
     */
    public function setCategories(Collection $categories): ProductAttr
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param ProductCategory $category
     *
     * @return bool
     */
    public function addCategory(ProductCategory $category): bool
    {
        if ($this->categories->contains($category)) {
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
     * @return string
     */
    public function __toString()
    {
       return (string) $this->getTitle();
    }
}

