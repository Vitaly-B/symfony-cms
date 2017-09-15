<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\ProductInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ProductAttrValue
 */
class ProductAttrValue
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var float
     */
    private $numberValue;

    /**
     * @var ProductAttr
     */
    private $attribute;

    /**
     * @var Product
     */
    private $product;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return ProductAttrValue
     */
    public function setValue($value): ProductAttrValue
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set numberValue
     *
     * @param int|float|null $numberValue
     *
     * @return ProductAttrValue
     */
    public function setNumberValue($numberValue): ProductAttrValue
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return int
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }


    /**
     * get attribute
     *
     * @return ProductAttr
     */
    public function getAttribute(): ?ProductAttr
    {
        return $this->attribute;
    }

    /**
     * get attribute
     *
     * @param ProductAttr|null $attribute
     *
     * @return ProductAttrValue
     */
    public function setAttribute(?ProductAttr $attribute): ProductAttrValue
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * set product
     *
     * @param Product $product
     *
     * @return ProductAttrValue
     */
    public function setProduct(?Product $product): ProductAttrValue
    {
        $this->product = $product;

        return $this;
    }

    /**
     * get product
     *
     * @return Product
     */
    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    public function __toString()
    {
        return $this->getId() . ':' . $this->getValue();
    }

    /**
     * validate value
     * @param ExecutionContextInterface $context
     * @param mixed $payload
     */
    public function validateValue(ExecutionContextInterface $context, $payload)
    {
        if($this->getAttribute() && $this->getAttribute()->getType() !== $this->getAttribute()::TYPE_STRING) {
            if(!is_numeric(str_replace(',','.',$this->getValue()))) {
                $context->buildViolation(
                    'This value must be {{ type }}',
                    [
                        '{{ type }}' => array_flip(
                            $this->getAttribute()::getTypes()
                        ) [$this->getAttribute()->getType()],
                    ]
                )
                    ->atPath('value')
                    ->addViolation();
            }

        }
    }

    /**
     *  preUpdate adn prePersists updateValues
     */
    public function updateValues()
    {
        if ($this->getAttribute()) {

            $this->setNumberValue(null);

            switch ($this->getAttribute()->getType()) {
                case $this->getAttribute()::TYPE_NUMBER:
                    $this->setNumberValue(floatval(str_replace(',', '.',$this->getValue())));
                    $this->setValue($this->getNumberValue());
                break;
            }

        }
    }
}

