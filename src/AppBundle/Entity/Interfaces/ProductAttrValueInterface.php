<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 12:46
 */

namespace App\AppBundle\Entity\Interfaces;

/**
 * ProductAttrValueInterface
 */
interface ProductAttrValueInterface extends IdentifierInterface
{
    public function setValue(?string $value): ProductAttrValueInterface;

    /**
     * Get value
     *
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * Set numberValue
     *
     * @param float|null $numberValue
     *
     * @return ProductAttrValueInterface
     */
    public function setNumberValue(?float $numberValue): ProductAttrValueInterface;

    /**
     * Get numberValue
     *
     * @return float|null
     */
    public function getNumberValue(): ?float;


    /**
     * get attribute
     *
     * @return ProductAttrInterface
     */
    public function getAttribute(): ?ProductAttrInterface;

    /**
     * get attribute
     *
     * @param ProductAttrInterface|null $attribute
     *
     * @return ProductAttrValueInterface
     */
    public function setAttribute(?ProductAttrInterface $attribute): ProductAttrValueInterface;

    /**
     * set product
     *
     * @param ProductInterface|null $product
     *
     * @return ProductAttrValueInterface
     */
    public function setProduct(?ProductInterface $product): ProductAttrValueInterface;

    /**
     * get product
     *
     * @return ProductInterface|null
     */
    public function getProduct(): ?ProductInterface;

    /**
     * @return int|null
     */
    public function getAttributeId(): ?int;

    /**
     * @param int|null $attributeId
     * @return ProductAttrValueInterface
     */
    public function setAttributeId(?int $attributeId): ProductAttrValueInterface;
}