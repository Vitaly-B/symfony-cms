<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\ProductAttrInterface;
use AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Entity\Interfaces\SortableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * CatalogAttr
 */
class ProductAttr implements SortableInterface, ProductAttrInterface
{
    use Traits\SortableTrait;
    use Traits\IdentifierTrait;

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
     * @return ProductAttrInterface
     */
    public function setTitle(?string $title): ProductAttrInterface
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
     * @return ProductAttrInterface
     */
    public function setType(int $type = self::TYPE_STRING): ProductAttrInterface
    {
        $this->type = $type;

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
     * @param Collection $categories
     *
     * @return ProductAttrInterface
     */
    public function setCategories(Collection $categories): ProductAttrInterface
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function addCategory(ProductCategoryInterface $category): bool
    {
        if ($this->categories->contains($category)) {
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
     * get values
     *
     * @return Collection|ProductAttrValueInterface[]
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * @param Collection|ProductAttrValue[] $values
     *
     * @return ProductAttrInterface
     */
    public function setValues(Collection $values): ProductAttrInterface
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param ProductAttrValueInterface $value
     *
     * @return bool
     */
    public function addValue(ProductAttrValueInterface $value): bool
    {
        if (!$this->values->contains($value)) {
            return $this->values->add($value);
        }

        return false;
    }

    /**
     * @param ProductAttrValueInterface $value
     *
     * @return bool
     */
    public function removeValue(ProductAttrValueInterface $value): bool
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
    public function __toString(): string
    {
        return $this->getId().':'.$this->getTitle();
    }
}

