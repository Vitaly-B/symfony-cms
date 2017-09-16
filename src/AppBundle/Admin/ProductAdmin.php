<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 23:01
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use AppBundle\Entity\Interfaces\ProductInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductAdmin extends AbstractAdmin
{
    protected $translationDomain = 'AppAdmin';

    protected function configureFormFields(FormMapper $form)
    {
        $form->tab('General')
                ->with('General')
                    ->add('title', null, ['label' => 'Title'])
                    ->add('description','textarea', ['label' => 'Description', 'required' => false])
                    ->add('content','ckeditor', ['label'    => 'Content', 'required' => false])
                    ->add('enabled', null, ['label' => 'Enabled'])
                    ->add('price','money', ['label' => 'Price','help'  => 'Format: 1,00', 'currency' => 'USD'])
                    ->add('categories',null, [
                        'label'        => 'Categories',
                        'expanded'     => true,
                        'multiple'     => true,
                        'choice_label' => 'titleLeveling',
                    ])
                    ->add('attrValues','sonata_type_collection',
                        [
                            'label'        => 'Attributes',
                            'by_reference' => false,
                            'required' => false,
                            'type_options' => [
                                'delete' => true,
                                'delete_options' => [
                                    // You may otherwise choose to put the field but hide it
                                    'type'         => 'checkbox',
                                    // In that case, you need to fill in the options as well
                                    'type_options' => [
                                        'mapped'   => false,
                                        'required' => false,
                                    ]
                                ]
                            ],
                        ],
                        [
                            'edit'   => 'inline',
                            'inline' => 'table',
                        ]
                    )
                ->end()
            ->end()
            ->tab('Media')
                ->with('Media')
                    ->add('image','sonata_media_type',[
                        'label'    => 'Image',
                        'required' => false,
                        'context'  => 'product',
                        'provider' => 'sonata.media.provider.image'
                    ])
                    ->add('gallery', 'sonata_type_model_list', ['label' => 'Gallery', 'required' => false],  ['link_parameters' => ['context' => 'product']])
                ->end()
            ->end()
                ->tab('Seo')
                    ->with('Seo')
                    ->add('seoTitle', null, ['label' => 'Seo title'])
                    ->add('seoKeywords', null, ['label' => 'Seo keywords'])
                    ->add('seoDescription','textarea',['label' => 'Seo description', 'required' => false])
                ->end()
            ->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('id')
                    ->add('title', null, ['label' => 'Title', 'editable' => true])
                    ->add('createdAt', null, ['label' => 'Created at'])
                    ->add('updatedAt', null, ['label' => 'Updated at'])
                    ->add('enabled',null, ['label' => 'Enabled', 'editable' => true])
                    ->add('price', null, ['label' => 'Price'])
                    ->add('_action',null,[
                        'actions' => [
                            'show'   => [],
                            'edit'   => [],
                            'delete' => []
                        ]
                    ]);
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show->tab('General')
                ->with('General')
                    ->add('title', null, ['label' => 'Title'])
                    ->add('description',null, ['label' => 'Description', 'required' => false])
                    ->add('content', null, ['label' => 'Content', 'safe' => true])
                    ->add('enabled', null, ['label' => 'Enabled'])
                    ->add('price', null, ['label' => 'Price'])
                    ->add('categories', null, ['label' => 'Categories'])
                    ->add('createdAt', null, ['label' => 'Created at'])
                    ->add('updatedAt', null, ['label' => 'Updated at'])
                ->end()
            ->end()
            ->tab('Media')
                ->with('Media')
                    ->add('image', null, ['label' => 'Image'])
                ->end()
            ->end()
            ->tab('Seo')
                ->with('Seo')
                    ->add('seoTitle', null, ['label' => 'Seo title'])
                    ->add('seoKeywords', null, ['label' => 'Seo keywords'])
                    ->add('seoDescription',null, ['label' => 'Seo description', 'required' => false])
                ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id')
            ->add('title', null, ['label' => 'Title']);
    }


    /**
     * @param ErrorElement $errorElement
     * @param ProductInterface $product
     */
    public function validate(ErrorElement $errorElement, $product)
    {
        if(!$product->getAttrValues()->isEmpty()) {

            /* @var ValidatorInterface $validator */
            $validator = $this->getConfigurationPool()->getContainer()->get('validator');

            /* @var ProductAttrValueInterface $attrValue*/
            foreach ($product->getAttrValues() as $key => $attrValue){

                if ($attrValue->getAttribute() !== null) {
                    if ($attrValue->getAttribute()->getType() !== $attrValue->getAttribute()::TYPE_STRING) {
                        $errors = $validator->validate($attrValue);
                        foreach($errors as $error) {
                            /* @var \Symfony\Component\Validator\ConstraintViolation $error */
                            $errorElement->with('attrValues['.$key.']')->with($error->getPropertyPath())->addViolation($error->getMessage());
                            //TODO bug on display error message from collection
                        }
                    }
                }

            }
        }
    }

}