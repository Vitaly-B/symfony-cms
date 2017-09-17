<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 14:23
 */

namespace AppBundle\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * ProductAttrInterface
 */
interface ProductAttrInterface extends SortableInterface
{
    /**
     * Get id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     *
     */
    public function getTitle(): ?string;

    /**
     * @param string|null $title
     *
     * @return ProductAttrInterface
     */
    public function setTitle(?string $title): ProductAttrInterface;

    /**
     * @return int|null
     */
    public function getType(): ?int;

    /**
     * @param int|null $type
     *
     * @return ProductAttrInterface
     */
    public function setType(?int $type): ProductAttrInterface;

    /**
     * @return Collection
     */
    public function getCategories(): Collection;

    /**
     * @param Collection $categories
     *
     * @return ProductAttrInterface
     */
    public function setCategories(Collection $categories): ProductAttrInterface;

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function addCategory(ProductCategoryInterface $category): bool;

    /**
     * @param ProductCategoryInterface $category
     *
     * @return bool
     */
    public function removeCategory(ProductCategoryInterface $category): bool;

    /**
     * get values
     *
     * @return Collection
     */
    public function getValues(): Collection;

    /**
     * @param Collection $values
     *
     * @return ProductAttrInterface
     */
    public function setValues(Collection $values): ProductAttrInterface;

    /**
     * @param ProductAttrValueInterface $value
     *
     * @return bool
     */
    public function addValue(ProductAttrValueInterface $value): bool;

    /**
     * @param ProductAttrValueInterface $value
     *
     * @return bool
     */
    public function removeValue(ProductAttrValueInterface $value): bool;
}