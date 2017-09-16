<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 14.09.2017
 * Time: 12:08
 */

namespace AppBundle\Admin;

use AppBundle\Entity\ProductAttr;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAttrAdmin extends AbstractAdmin
{
    protected $translationDomain = 'AppAdmin';

    protected function configureFormFields(FormMapper $form)
    {
        $form->add('title', null, ['label' => 'Title'])->add('type')
            ->add('type','choice',[
                'choices'            => ProductAttr::getTypes(),
                'multiple'           => false,
                'label'              => 'Type',
            ])
            ->add('categories',null, [
                'required'     => true,
                'label'        => 'Categories',
                'expanded'     => true,
                'multiple'     => true,
                'choice_label' => 'titleLeveling',
            ])
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('id')
            ->add('title', null, ['label' => 'Tile', 'editable' => true])
            ->add('_action',null,[
                'actions' => [
                    'edit'   => [],
                    'delete' => []
                ]
            ]);

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id')->add('title', null, ['Label' => 'Title']);
    }
}