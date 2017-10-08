<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.09.2017
 * Time: 19:18
 */

namespace AppBundle\Model\Types\Range;

/**
 * Range
 */
class FloatRange implements RangeInterface
{
    /**
     * @var float
     */
    private $min;

    /**
     * @var float
     */
    private $max;

    public function __construct(float $min, float $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

}