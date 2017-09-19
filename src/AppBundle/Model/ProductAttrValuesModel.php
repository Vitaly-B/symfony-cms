<?php

/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 19.09.2017
 * Time: 23:55
 */

namespace AppBundle\Model;

use AppBundle\Entity\ProductAttrValue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppBundle\Entity\ProductAttr;

/**
 * ProductAttrValuesModel
 */
class ProductAttrValuesModel
{
    /* @var int */
    private $_attribute;

    /* @var Collection*/
    private $_values;

    public function __construct(ProductAttr $productAttr)
    {
        $this->_attribute = $productAttr;
        $this->_values = new ArrayCollection();
    }

    /**
     * @param string $name
     * @return mixed
     *
     * @throws \Exception
     */
    public function __get($name)
    {
        if(method_exists($this->_attribute,'get'.ucfirst($name))) {
            return $this->_attribute->{'get'.ucfirst($name)}();
        } else {
            throw new  \Exception('Undefined property ' . static::class .'.' . $name);
        }
    }

    /**
     * @param string $name
     * @param mixed|null $arguments
     *
     * @return mixed|null
     * @throws \Exception
     */
    function __call($name, $arguments)
    {
        if(method_exists($this->_attribute,'get'.ucfirst($name))) {
            return $this->_attribute->{'get'.ucfirst($name)}($arguments);
        } else {
            throw new  \Exception('Undefined method ' . static::class .'::' . $name);
        }
    }


    /**
     * @return Collection|ProductAttrValue[]
     */
    public function getValues(): Collection
    {
        return $this->_values;
    }

    /**
     * @param Collection|ProductAttrValue[]  $values
     *
     * @return ProductAttrValuesModel
     */
    public function setValues(Collection $values)
    {
        $this->_values = $values;

        return $this;
    }

    /**
     * @param ProductAttrValue $value
     *
     * @return bool
     */
    public function addValue(ProductAttrValue $value): bool
    {
        if (!$this->_values->contains($value)) {
            return $this->_values->add($value);
        }

        return false;
    }

    /**
     * @param ProductAttrValue $value
     *
     * @return bool
     */
    public function removeValue(ProductAttrValue $value): bool
    {
        return $this->_values->removeElement($value);
    }
}