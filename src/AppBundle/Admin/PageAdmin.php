<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 04.09.2017
 * Time: 0:13
 */

namespace App\AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\TranslationBundle\Filter\TranslationFieldFilter;

/**
 * PageAdmin
 */
class PageAdmin extends AbstractAdmin
{
    protected $translationDomain = 'App\AppBundle\Admin';

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->tab('General')
                ->with('General')
                    ->add('title', null, ['label' => 'Title'])
                    ->add('description', 'textarea', ['label' => 'Description', 'required' => false])
                    ->add('content', 'ckeditor', [
                        'label' => 'Content',
                        'required' => false
                    ])
                    ->add('enabled', null, ['label' => 'Enabled'])
                ->end()
            ->end()
            ->tab('Seo')
                ->with('Seo')
                    ->add('seoTitle', null, ['label' => 'Seo title'])
                    ->add('seoKeywords', null, ['label' => 'Seo keywords'])
                    ->add('seoDescription', 'textarea', ['label' => 'Seo description', 'required' => false])
                ->end()
            ->end();
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('id')
            ->add('title', null, ['label' => 'Title', 'editable' => true])
            ->add('createdAt', null, ['label' => 'Created at'])
            ->add('updatedAt', null, ['label' => 'Updated at'])
            ->add('enabled', null, ['label' => 'Enabled', 'editable' => true])
            ->add('_action', null, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ]);
        ;
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show->tab('General')
                ->with('General')
                    ->add('title', null, ['label' => 'Title'])
                    ->add('description',null, ['label' => 'Description', 'required' => false])
                    ->add('content', null, ['label' => 'Content', 'safe' => true])
                    ->add('enabled', null, ['label' => 'Enabled'])
                    ->add('createdAt', null, ['label' => 'Created at'])
                    ->add('updatedAt', null, ['label' => 'Updated at'])
                ->end()
            ->end()
                ->tab('Seo')
                    ->with('Seo')
                    ->add('seoTitle', null, ['label' => 'Seo title'])
                    ->add('seoKeywords', null, ['label' => 'Seo keywords'])
                    ->add('seoDescription', null, ['label' => 'Seo description', 'required' => false])
                ->end()
            ->end();
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id')
            ->add('title', TranslationFieldFilter::class, ['label' => 'Title'])
        ;
    }
}