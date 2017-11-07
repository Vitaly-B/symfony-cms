<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 16:35
 */

namespace App\AppBundle\Model\Filter;

use App\AppBundle\Model\Filter\Exception\Exception;

/**
 * FilterAttrValue
 */
class FilterAttrValue implements FilterValueInterface
{

    /* @var bool */
    private $active = false;

    /* @var string|int */
    private $key;

    /* @var string|int|float $value*/
    private $value;

    /* @var FilterAttrInterface */
    private $attribute;

    /* @var string|bool|null */
    private $label;

    public function __construct($key, $value, FilterAttrInterface $attribute, ?string $label = null)
    {
        $this->key       = $key;
        $this->value     = $value;
        $this->attribute = $attribute;
        $this->label     = $label;
    }

    /**
     * @return string|int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string|int|float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string|int|float $value
     *
     * @return FilterValueInterface
     */
    public function setValue($value): FilterValueInterface
    {
        $this->value = $value;
        $this->setActive(true);
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return FilterAttrInterface
     */
    public function getAttribute(): FilterAttrInterface
    {
        return $this->attribute;
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
     * @return FilterValueInterface
     */
    public function setActive(bool $active): FilterValueInterface
    {
        $this->active = $active;

        $this->attribute->setActive($active);

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
        return $this->attribute->getType();
    }

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return in_array($offset, ['value', 'active']);
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
            case 'value':
                return $this->value;
            break;
            case 'active':
                return $this->getActive();
            break;
            default:
                throw new Exception("Property ".FilterAttrValue::class.".".$offset." not exists");
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
            case 'value':
                $this->setValue($value);
            break;
            case 'active':
                $this->setActive($value);
            break;
            default:
                throw new Exception("Property ".FilterAttrValue::class.".".$offset." not exists");
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
            case 'value':
                $this->value = null;
            break;
            case 'active':
                return $this->setActive(false);
            break;
            default:
                throw new Exception("Property ".FilterAttrValue::class.".".$offset." not exists");
            break;
        }
    }
}