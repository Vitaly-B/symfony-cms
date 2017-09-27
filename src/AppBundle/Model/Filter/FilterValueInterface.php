<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 16:58
 */

namespace AppBundle\Model\Filter;


interface FilterValueInterface
{
    /**
     * @return string|int
     */
    public function getKey();

    /**
     * @return string|int|float
     */
    public function getValue();

    /**
     * @return string
     */
    public function getLabel(): ?string;

    /**
     * @param string|int|float $value
     *
     * @return FilterValueInterface
     */
    public function setValue($value): FilterValueInterface;

    /**
     * @return FilterAttrInterface
     */
    public function getAttribute(): FilterAttrInterface;

    /**
     * @return bool
     */
    public function getActive(): bool;

    /**
     * @param bool $active
     *
     * @return FilterValueInterface
     */
    public function setActive(bool $active): FilterValueInterface;

    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @return string
     */
    public function getType(): string;
}