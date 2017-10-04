<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 19:55
 */

namespace AppBundle\Model\Filter;

use Doctrine\Common\Collections\Collection;

interface FilterInterface
{
    /**
     * @return Collection|FilterAttrInterface[]
     */
    public function getAttributes(): Collection;

    /**
     * @param string|int $key
     *
     * @return bool
     */
    public function hasAttribute($key): bool;

    /**
     * @param string|int $key
     *
     * @return FilterAttrInterface|null
     */
    public function getAttribute($key): ?FilterAttrInterface;

    /**
     * @param FilterAttrInterface $attr
     *
     * @return FilterInterface
     */
    public function addAttribute(FilterAttrInterface $attr): FilterInterface;

    /**
     * @param string|int
     *
     * @return bool
     */
    public function removeAttribute($key): bool;

    /**
     * @return bool
     */
    public function getActive(): bool;

    /**
     * @param bool $active
     *
     * @return void
     */
    public function setActive(bool $active): void;

    /**
     * @return bool
     */
    public function isActive(): bool;

}