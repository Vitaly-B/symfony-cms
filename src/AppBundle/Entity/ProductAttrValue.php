<?php

namespace AppBundle\Entity;

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
     * @var string|int|float
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
     * @var Collection|Product[]
     */
    private $product;

    /* @var int */
    private $attributeId;

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
     * @param string|null $value
     *
     * @return ProductAttrValue
     */
    public function setValue(?string $value): ProductAttrValue
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set numberValue
     *
     * @param float|null $numberValue
     *
     * @return ProductAttrValue
     */
    public function setNumberValue(?float $numberValue): ProductAttrValue
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return float|null
     */
    public function getNumberValue(): ?float
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
     * @param Product|null $product
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
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
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

    /**
     * @return int|null
     */
    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    /**
     * @param int|null $attributeId
     * @return ProductAttrValue
     */
    public function setAttributeId(?int $attributeId): ProductAttrValue
    {
        $this->attributeId = $attributeId;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getId().':'.$this->getValue();
    }
}

