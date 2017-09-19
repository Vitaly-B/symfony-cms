<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductAttr;
use AppBundle\Entity\ProductAttrValue;
use AppBundle\Managers\ProductAttrValueManager;
use AppBundle\Managers\ProductCategoryManager;
use AppBundle\Model\ProductAttrValuesModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductAttrController
 */
class ProductAttrController extends Controller
{
    /**
     * @param int|null $categoryId
     *
     * @return Response
     */
    public function filterFormAction(?int $categoryId = null): Response
    {
        /**
         * TODO перенести этот функционал в $productAttrManager
         * Также реализовать пулл Для ProductAttrValuesModel Который потом попытаться использовать в форме
         */

        /* @var ProductAttrValueManager $productAttrValueManager */
        $productAttrValueManager = $this->get('app.product_attribute_value_manager');
        /* @var ProductCategoryManager $productCategoryManager */
        $productCategoryManager = $this->get('app.product_category_manager');

        /* @var ProductAttrValue[] $attrValueArr */
        $attrValueArr = $productAttrValueManager->getUniqueValuesByCategory($categoryId ? $productCategoryManager->getById($categoryId) : null);

        /* @var ProductAttr $attrArr cloned objects */
        $attrArr = [];
        array_walk($attrValueArr, function(ProductAttrValue $attrValue) use(&$attrArr) {
            if(!array_key_exists($attrValue->getAttribute()->getId(), $attrArr)) {
                $attribute = new ProductAttrValuesModel($attrValue->getAttribute());
                $attribute->addValue($attrValue);
                $attrArr[$attribute->id] = $attribute;
            } else {
                $attrArr[$attrValue->getAttribute()->getId()]->addValue($attrValue);
            }
        });

        return $this->render('AppBundle:ProductAttr:_filter_form.html.twig', ['attributes' => array_values($attrArr)]);
    }
}
