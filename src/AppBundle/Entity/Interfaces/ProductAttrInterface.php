<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 12:54
 */

namespace AppBundle\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * ProductAttrInterface
 */
interface ProductAttrInterface extends IdentifierInterface
{
    const TYPE_STRING = 1;
    const TYPE_NUMBER = 2;

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
     * @param int $type
     *
     * @return ProductAttrInterface
     */
    public function setType(int $type = self::TYPE_STRING): ProductAttrInterface;


    /**
     * @return Collection|ProductCategoryInterface[]
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
     * @return Collection|ProductAttrValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param Collection|ProductAttrValueInterface[] $values
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

    /**
     * get supported types
     *
     * @return array
     */
    public static function getTypes(): array;
}