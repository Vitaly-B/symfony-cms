<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 23.09.2017
 * Time: 1:16
 */

namespace AppBundle\Form\Filter;

use AppBundle\Model\Filter\FilterInterface;
use AppBundle\Managers\FilterManager;
use AppBundle\Model\Filter\FilterAttr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Model\Filter\Filter;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * FilterAttrType
 */
class FilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('GET');

        $builder->add('attributes',CollectionType::class,
            [
                'label'         => false,
                'required'      => false,
                'entry_type'    => FilterAttrType::class,
                'entry_options' => ['label' => false],
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Filter::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_form_filter_filter_type';
    }
}