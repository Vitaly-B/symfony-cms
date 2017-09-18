<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ProductCategory
 */
class ProductCategory
{
    use Traits\NestedSetTrait;

    /* @var int */
    private $id;

    /* @var string */
    private $title;

    /* @var Collection|Product[] */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
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
     * @return ProductCategory
     */
    public function setTitle(?string $title): ProductCategory
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
     * @param  string $repeatStr
     *
     * @return string
     */
    public function getTitleLeveling(string $repeatStr = '-'): ?string
    {
        return str_repeat($repeatStr, $this->getLvl()).' '.$this->getTitle();
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param Collection|Product[] $products
     *
     * @return ProductCategory
     */
    public function setProducts(Collection $products): ProductCategory
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function addProduct(Product $product): bool
    {
        if(!$this->products->contains($product)) {
            return $this->products->add($product);
        }

        return false;
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function removeProduct(Product $product): bool
    {
        return $this->products->removeElement($product);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getId().':'.$this->getTitle();
    }
}
