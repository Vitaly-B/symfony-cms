<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 23.09.2017
 * Time: 17:38
 */

namespace App\AppBundle\Form\Filter;

use App\AppBundle\Model\Filter\FilterAttrValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * FilterAttrValueType
 */
class FilterAttrValueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('GET');
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            /* @var FilterAttrValue $filterAttrValue */
            $filterAttrValue = $event->getData();
            $form            = $event->getForm();

            if($filterAttrValue->getType() === CheckboxType::class) {

                $form->add( 'active', $filterAttrValue->getType(),
                    [
                        'label'    => $filterAttrValue->getLabel() !== null ? $filterAttrValue->getLabel() : false,
                        'required' => false,
                    ]
                );
            } else {

                $form->add( 'value', $filterAttrValue->getType(),
                    [
                        'label'    => $filterAttrValue->getLabel() !== null ? $filterAttrValue->getLabel() : false,
                        'required' => false,
                    ]
                );
            }

        });

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FilterAttrValue::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_form_filter_filter_attr_value_type';
    }
}