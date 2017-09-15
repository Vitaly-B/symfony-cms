<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 14.09.2017
 * Time: 20:56
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Product;
use AppBundle\Entity\ProductAttrValue;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class ProductAttrValueAdmin extends AbstractAdmin
{
    protected $translationDomain = 'AppAdmin';

    protected function configureFormFields(FormMapper $form)
    {

        /* @var ProductAttrValue $productAttrVale*/
        $productAttrVale = $this->getSubject();

        /* @var Request $request */
        $request = $this->getRequest();

        $product        = null;


        if($productAttrVale !== null && ($productId = $request->get('objectId')) !== null) {
            /* @var  Product $product */
            $product = $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Product::class)->find((int)$productId);

            $productAttrVale->setProduct($product);

        }


        $form->add('attribute', null, ['label' => 'Attribute'])
            ->add('product', null , ['label' => 'Product'])
            ->add('value', null, ['label' => 'Value'])
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('id')
            ->add('attribute', null, ['label' => 'Attribute'])
            ->add('product', null, ['label' => 'Product'])
            ->add('value', null, ['label' => 'Value', 'editable' => true])
            ->add('_action',null,[
                'actions' => [
                    'edit'   => [],
                    'delete' => []
                ]
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id')
            ->add('value', null, ['label' => 'Value'])
            ->add('attribute', null, ['label' => 'Attribute'])
            ->add('product', null, ['label' => 'Product'])
        ;
    }
}