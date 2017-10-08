<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.09.2017
 * Time: 19:17
 */

namespace AppBundle\Model\Types\Range;

/**
 *
 * RangeInterface
 */
interface RangeInterface
{
    /**
     * @return int|float
     */
    public function getMin();

    /**
     * @return int|float
     */
    public function getMax();
}