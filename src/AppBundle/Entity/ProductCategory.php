<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\NestedSetInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ProductCategory
 */
class ProductCategory implements NestedSetInterface
{
    use Traits\NestedSetTrait;

    /* @var int */
    private $id;

    /* @var string */
    private $title;

    /* @var Collection */
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
     * @return Collection;
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     *
     * @return ProductCategory;
     */
    public function setProducts(ArrayCollection $products): ProductCategory
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param ProductInterface $product
     *
     * @return bool
     */
    public function addProduct(ProductInterface $product): bool
    {
        if($this->products->contains($product)) {
            return $this->products->add($product);
        }

        return false;
    }

    /**
     * @param ProductInterface $product
     *
     * @return bool
     */
    public function removeProduct(ProductInterface $product): bool
    {
        return $this->products->removeElement($product);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
