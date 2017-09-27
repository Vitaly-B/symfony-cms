<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 16:37
 */

namespace AppBundle\Model\Filter;

use Doctrine\Common\Collections\Collection;

/**
 * FilterAttrInterface
 */
interface FilterAttrInterface
{
    /**
     * @return string|int
     */
    public function getKey();

    /**
     * @return string
     */
    public function getLabel(): ?string;

    /**
     * @return Collection|FilterValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param FilterValueInterface $filterValue
     *
     * @return FilterAttrInterface
     */
    public function addValue(FilterValueInterface $filterValue): FilterAttrInterface;

    /**
     * @param string|int $key
     *
     * @return FilterValueInterface|null
     */
    public function getValue($key): ?FilterValueInterface;

    /**
     * @param string|int $key
     *
     * @return bool
     */
    public function hasValue($key): bool;

    /**
     * @param string|int $key
     * @return bool
     */
    public function removeValue($key): bool;

    /**
     * @return bool
     */
    public function getActive(): bool;

    /**
     * @param bool $active
     *
     * @return FilterAttrInterface
     */
    public function setActive(bool $active): FilterAttrInterface;

    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @return string
     */
    public function getType(): string;
}