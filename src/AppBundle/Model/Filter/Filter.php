<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 20:41
 */

namespace AppBundle\Model\Filter;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Filter
 */
class Filter implements FilterInterface
{
    /* @var ArrayCollection */
    private $attributes;

    /* @var bool */
    private $active = false;


    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * @return Collection|FilterAttrInterface[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @param string|int $key
     *
     * @return bool
     */
    public function hasAttribute($key): bool
    {
        return $this->attributes->containsKey($key);
    }

    /**
     * @param string|int $key
     *
     * @return FilterAttrInterface|null
     */
    public function getAttribute($key): ?FilterAttrInterface
    {
        return $this->attributes->get($key);
    }

    /**
     * @param FilterAttrInterface $attr
     *
     * @return FilterInterface
     */
    public function addAttribute(FilterAttrInterface $attr): FilterInterface
    {
        $this->attributes->set($attr->getKey(), $attr);

        return $this;
    }

    /**
     * @param string|int
     *
     * @return bool
     */
    public function removeAttribute($key): bool
    {
       $this->attributes->remove($key);
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return void
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->getActive();
    }
}