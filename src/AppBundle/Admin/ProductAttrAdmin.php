<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 14.09.2017
 * Time: 12:08
 */

namespace App\AppBundle\Admin;

use App\AppBundle\Entity\ProductAttr;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * ProductAttrAdmin
 */
class ProductAttrAdmin extends AbstractAdmin
{
    protected $translationDomain = 'App\AppBundle\Admin';

    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'position',
    ];

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('move', $this->getRouterIdParameter().'/move/{position}');
    }

    /**
     * @param FormMapper $form
     */
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

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('id')
            ->add('position', null, ['label' => 'Position'])
            ->add('title', null, ['label' => 'Tile', 'editable' => true])
            ->add('_action',null,[
                'actions' => [
                    'edit'   => [],
                    'delete' => [],
                    'move' => [],
                ]
            ]);

    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id')->add('title', null, ['Label' => 'Title']);
    }
}