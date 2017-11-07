<?php

/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 19.09.2017
 * Time: 23:55
 */

namespace App\AppBundle\Model\Filter;

use App\AppBundle\Model\Filter\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * FilterAttr
 */
class FilterAttr implements FilterAttrInterface
{
    /* @var string|int */
    private $key;

    /* @var string */
    private $label;

    /* @var Filter */
    private $filter;

    /* @var string */
    private $type;

    /* @var  ArrayCollection|FilterValueInterface[] */
    private $values;

    /* @var bool */
    private $active = false;

    public function __construct($key, string $label, FilterInterface $filter, string $type = CheckboxType::class)
    {
        $this->key    = $key;
        $this->label  = $label;
        $this->filter = $filter;
        $this->type   = $type;
        $this->values = new ArrayCollection();
    }

    /**
     * @return string|int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return Collection|FilterValueInterface[]
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * @param FilterValueInterface $filterValue
     *
     * @return FilterAttrInterface
     */
    public function addValue(FilterValueInterface $filterValue): FilterAttrInterface
    {
        $this->values->set($filterValue->getKey(), $filterValue);

        return $this;
    }

    /**
     * @param string|int $key
     *
     * @return FilterValueInterface|null
     */
    public function getValue($key): ?FilterValueInterface
    {
        return $this->values->get($key);
    }

    /**
     * @param string|int $key
     *
     * @return bool
     */
    public function hasValue($key): bool
    {
        return $this->values->containsKey($key);
    }

    /**
     * @param string|int $key
     * @return bool
     */
    public function removeValue($key): bool
    {
        return $this->values->remove($key);
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
     * @return FilterAttrInterface
     */
    public function setActive(bool $active): FilterAttrInterface
    {
        $this->active = $active;
        $this->filter->setActive($active);
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->getActive();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return in_array($offset, ['values']);
    }

    /**
     * @param string|int $offset
     * @return mixed
     *
     * @throws Exception
     */
    public function offsetGet($offset)
    {
        switch ($offset) {
            case 'values':
                return $this->values;
            break;
            default:
                throw new Exception("Property ".FilterAttr::class.".".$offset." not exists");
            break;
        }
    }

    /**
     * @param string|int $offset
     * @param mixed $value
     *
     * @throws Exception
     */
    public function offsetSet($offset, $value)
    {
        switch ($offset) {
            case 'values':
                $this->values = $value;
            break;
            default:
                throw new Exception("Property ".FilterAttr::class.".".$offset." not exists");
            break;
        }
    }

    /**
     * @param string|int $offset
     * @return void
     * @throws Exception
     */
    public function offsetUnset($offset)
    {
        switch ($offset) {
            case 'values':
                $this->values = new ArrayCollection();
            break;
            default:
                throw new Exception("Property ".FilterAttr::class.".".$offset." not exists");
            break;
        }
    }

}