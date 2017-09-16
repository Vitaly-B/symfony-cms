<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 14.09.2017
 * Time: 20:56
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\Request;

class ProductAttrValueAdmin extends AbstractAdmin
{
    protected $translationDomain = 'AppAdmin';

    protected function configureFormFields(FormMapper $form)
    {

        /* @var ProductAttrValueInterface $productAttrVale*/
        $productAttrVale = $this->getSubject();

        /* @var Request $request */
        $request = $this->getRequest();

        $valueFieldHelp   = null;

        if($productAttrVale) {
            if (($productId = $request->get('objectId')) !== null) {
                /* @var  ProductInterface $product */
                $product = $this->getModelManager()->getEntityManger()->getRepository(Product::class)->find((int)$productId);

                $productAttrVale->setProduct($product);
            }
        }


        if ($productAttrVale && $productAttrVale->getAttribute()) {
            $valueFieldHelp = 'Type: '.array_flip(
                    $productAttrVale->getAttribute()::getTypes()
                )[$productAttrVale->getAttribute()->getType()];
        }

        $form->add('attribute', null, ['label' => 'Attribute'])
            ->add('product', null, ['label' => 'Product'])
            ->add('value', null, ['label' => 'Value', 'sonata_help' => $valueFieldHelp])
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