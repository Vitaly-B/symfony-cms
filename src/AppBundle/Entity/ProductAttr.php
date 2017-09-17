<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * CatalogAttr
 */
class ProductAttr
{
    use Traits\SortableTrait;

    const TYPE_STRING = 1;
    const TYPE_NUMBER = 2;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /*@var int*/
    private $type;

    /**
     * @var Collection|ProductCategory[]
     */
    private $categories;

    /**
     * @var Collection
     */
    private $values;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->values     = new ArrayCollection();
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
     * @return string|null
     *
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return ProductAttr
     */
    public function setTitle(?string $title): ProductAttr
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return ProductAttr
     */
    public function setType(int $type = self::TYPE_STRING): ProductAttr
    {
        $this->type = $type;

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
     * @param Collection $categories
     *
     * @return ProductAttr
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
     * get values
     *
     * @return Collection|ProductAttrValue[]
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * @param Collection|ProductAttrValue[] $values
     *
     * @return ProductAttr
     */
    public function setValues(Collection $values): ProductAttr
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param ProductAttrValue $value
     *
     * @return bool
     */
    public function addValue(ProductAttrValue $value): bool
    {
        if (!$this->values->contains($value)) {
            return $this->values->add($value);
        }

        return false;
    }

    /**
     * @param ProductAttrValue $value
     *
     * @return bool
     */
    public function removeValue(ProductAttrValue $value): bool
    {
        return $this->values->removeElement($value);
    }

    /**
     * get supported types
     *
     * @return array
     */
    public static function getTypes(): array
    {
        return ['String' => static::TYPE_STRING, 'Number' => static::TYPE_NUMBER];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId().':'.$this->getTitle();
    }
}

