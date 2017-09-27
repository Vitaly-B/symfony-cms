<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.09.2017
 * Time: 19:17
 */

namespace AppBundle\Model\Types;

/**
 *
 * RangeInterface
 */
interface RangeInterface
{
    /**
     * @return float
     */
    public function getMin(): float;

    /**
     * @return float
     */
    public function getMax(): float;
}