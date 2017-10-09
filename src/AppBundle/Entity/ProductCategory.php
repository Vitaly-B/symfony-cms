<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ProductCategory
 */
class ProductCategory implements ProductCategoryInterface
{
    use Traits\IdentifierTrait;
    use Traits\NestedSetTrait;

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
     * Set title
     *
     * @param string $title
     *
     * @return ProductCategoryInterface
     */
    public function setTitle(?string $title): ProductCategoryInterface
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
     * @param Collection|ProductInterface[] $products
     *
     * @return ProductCategoryInterface
     */
    public function setProducts(Collection $products): ProductCategoryInterface
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
        if(!$this->products->contains($product)) {
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
    public function __toString(): string
    {
        return $this->getId().':'.$this->getTitle();
    }
}
