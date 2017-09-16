<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\ProductAttrInterface;
use AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ProductAttrValue
 */
class ProductAttrValue implements Interfaces\ProductAttrValueInterface
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
     * @param string $value|null
     *
     * @return ProductAttrValueInterface
     */
    public function setValue(?string $value): ProductAttrValueInterface
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
     * @return ProductAttrValueInterface
     */
    public function setNumberValue(?float $numberValue): ProductAttrValueInterface
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
     * @return ProductAttrInterface
     */
    public function getAttribute(): ?ProductAttrInterface
    {
        return $this->attribute;
    }

    /**
     * get attribute
     *
     * @param ProductAttrInterface|null $attribute
     *
     * @return ProductAttrValueInterface
     */
    public function setAttribute(?ProductAttrInterface $attribute): ProductAttrValueInterface
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * set product
     *
     * @param ProductInterface|null $product
     *
     * @return ProductAttrValueInterface
     */
    public function setProduct(?ProductInterface $product): ProductAttrValueInterface
    {
        $this->product = $product;

        return $this;
    }

    /**
     * get product
     *
     * @return ProductInterface|null
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

