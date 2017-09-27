<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 22.09.2017
 * Time: 22:50
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductAttrValue;
use AppBundle\Model\Filter\Filter;
use AppBundle\Model\Filter\FilterAttrInterface;
use AppBundle\Model\Filter\FilterAttrValue;
use AppBundle\Model\Filter\FilterInterface;
use AppBundle\Model\Filter\FilterAttr;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\ProductCategory;

/**
 * FilterManager
 */
final class FilterManager
{
    /* @var ProductAttrValueManager */
    private $productAttrValueManager;

    /* @var ProductCategory */
    private $productCategory;

    public function __construct(ProductAttrValueManager $productAttrValueManager)
    {
        $this->productAttrValueManager = $productAttrValueManager;
    }

    /**
     * @param ProductCategory|null $productCategory
     */
    public function setProductCategory(?ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * @return FilterInterface
     */
    public function filterFactory()
    {
        /* @var ProductAttrValue[] $attrValueArr */
        $attrValueArr = $this->productAttrValueManager->getUniqueValuesByCategory($this->productCategory ? $this->productCategory : null);

        $filter = new Filter();

        array_walk($attrValueArr, function(ProductAttrValue $attrValue) use($filter) {

            if(!$filter->hasAttribute($attrValue->getAttribute()->getId())) {
                $attribute = new FilterAttr($attrValue->getAttribute()->getId(),$attrValue->getAttribute()->getTitle(), $filter, CheckboxType::class);
                $filter->addAttribute($attribute);
            } else {
                $attribute = $filter->getAttribute($attrValue->getAttribute()->getId());
            }
            $attribute->addValue(new FilterAttrValue($attrValue->getId(), $attrValue->getValue(), $attribute, $attrValue->getValue()));
        });

        //Add price filter
        $attributePrice = new FilterAttr('price', 'Price', $filter,TextType::class);
        $attributePrice->addValue(new FilterAttrValue('min', 0.22, $attributePrice, 'Min'));
        $attributePrice->addValue(new FilterAttrValue('max', 9999.99, $attributePrice, 'Max'));

        $filter->addAttribute($attributePrice);

        return $filter;
    }

}