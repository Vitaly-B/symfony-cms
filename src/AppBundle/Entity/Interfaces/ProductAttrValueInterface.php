<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 14:22
 */

namespace AppBundle\Entity\Interfaces;

/**
 * ProductAttrValueInterface
 */
interface ProductAttrValueInterface
{
    /**
     * Get id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Set value
     *
     * @param string $value|null
     *
     * @return ProductAttrValueInterface
     */
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
}