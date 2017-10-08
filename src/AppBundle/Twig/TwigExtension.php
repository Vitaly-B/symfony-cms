<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 30.08.2017
 * Time: 1:10
 */

namespace AppBundle\Twig;

use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * TwigExtension
 */
class TwigExtension extends \Twig_Extension
{
    public $container;

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sort_by_field', function ($data, $propertyPath = null, $direction = 'asc') {

                $flip = ($direction === 'desc') ? -1 : 1;

                usort($data, function($a, $b) use($propertyPath, $direction, $flip) {

                    if($propertyPath) {
                        $propertyAccessor = PropertyAccess::createPropertyAccessor();

                        $a_sort_value = $propertyAccessor->getValue($a, $propertyPath);
                        $b_sort_value = $propertyAccessor->getValue($b, $propertyPath);
                    } else {
                        $a_sort_value = $a;
                        $b_sort_value = $b;
                    }

                    if ($a_sort_value == $b_sort_value) {
                        return 0;
                    } else if ($a_sort_value > $b_sort_value) {
                        return (1 * $flip);
                    } else {
                        return (-1 * $flip);
                    }
                });

                return $data;
            }),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('str_repeat', function (string $input, int $multiplier) {
                return str_repeat($input, $multiplier);
            }),
        ];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return static::class;
    }
}