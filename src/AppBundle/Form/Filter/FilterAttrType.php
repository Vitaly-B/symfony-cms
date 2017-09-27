<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 23.09.2017
 * Time: 17:34
 */

namespace AppBundle\Form\Filter;

use AppBundle\Model\Filter\FilterAttr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * FilterAttrType
 */
class FilterAttrType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('GET');
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            /* @var FilterAttr $filterAttr */
            $filterAttr= $event->getData();
            $form = $event->getForm();

            $form->add('values',CollectionType::class,
                [
                    'label'         => $filterAttr->getLabel(),
                    'required'      => false,
                    'entry_type'    => FilterAttrValueType::class,
                    'entry_options' => ['label' => false],
                ]
            );

        });

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FilterAttr::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_form_filter_filter_attr_type';
    }
}