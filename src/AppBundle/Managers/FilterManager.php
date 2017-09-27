<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 22:50
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductAttrValue;
use AppBundle\Model\Filter\FilterAttrValue;
use AppBundle\Model\Filter\FilterInterface;
use AppBundle\Model\Filter\FilterAttr;
use AppBundle\Model\Types\RangeInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use AppBundle\Form\Filter\FilterType;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * FilterManager
 */
final class FilterManager
{
    /* @var ProductAttrValueManager */
    private $productAttrValueManager;

    /* @var ProductManager */
    private $productManager;

    /* @var string */
    private $class;

    /* @var FormFactoryInterface*/
    private $formFactory;

    /* @var FormInterface*/
    private $filterForm;

    /* @var $requestStack */
    private $requestStack;

    /* @var  FilterInterface */
    private $filter;

    public function __construct(
        string $class,
        ProductAttrValueManager $productAttrValueManager,
        ProductManager $productManager,
        FormFactoryInterface $formFactory,
        RequestStack $requestStack
    )
    {
        $this->class                    = $class;
        $this->productAttrValueManager = $productAttrValueManager;
        $this->productManager          = $productManager;
        $this->formFactory             = $formFactory;
        $this->requestStack            = $requestStack;

        $this->buildFilter();
    }

    /**
     * @return void
     */
    private function buildFilter()
    {
        $this->filter = new $this->class;

        /* @var ProductAttrValue[] $attrValueArr */
        $attrValueArr = $this->productAttrValueManager->getUniqueValuesByCategory($this->productManager->getProductCategory());

        array_walk($attrValueArr, function(ProductAttrValue $attrValue) {

            if(!$this->filter->hasAttribute($attrValue->getAttribute()->getId())) {
                $attribute = new FilterAttr($attrValue->getAttribute()->getId(),$attrValue->getAttribute()->getTitle(), $this->filter, CheckboxType::class);
                $this->filter->addAttribute($attribute);
            } else {
                $attribute = $this->filter->getAttribute($attrValue->getAttribute()->getId());
            }
            $attribute->addValue(new FilterAttrValue($attrValue->getId(), $attrValue->getValue(), $attribute, $attrValue->getValue()));
        });

        //Add price filter
        /* @var RangeInterface $priceRange */
        $priceRange = $this->productManager->getMinAndMaxPrice();

        $attributePrice = new FilterAttr('price', 'Price', $this->filter,TextType::class);
        $attributePrice->addValue(new FilterAttrValue('min', $priceRange->getMin(), $attributePrice, 'Min'));
        $attributePrice->addValue(new FilterAttrValue('max', $priceRange->getMax(), $attributePrice, 'Max'));

        $this->filter->addAttribute($attributePrice);

        $this->filterForm = $this->formFactory->create(FilterType::class, $this->filter);
        $this->filterForm->handleRequest($this->requestStack->getMasterRequest());
    }

    /**
     * @return FilterInterface
     */
    public function getFilter(): FilterInterface
    {
        return $this->filter;
    }

    /**
     * @return FormInterface
     */
    public function getFilterForm(): FormInterface
    {
        return $this->filterForm;
    }
}