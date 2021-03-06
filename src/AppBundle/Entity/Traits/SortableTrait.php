<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 14:15
 */

namespace App\AppBundle\Entity\Traits;


use App\AppBundle\Entity\Interfaces\SortableInterface;

trait SortableTrait
{
    /* @var int */
    private $position;

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     * @return SortableTrait
     */
    public function setPosition(?int $position)
    {
        $this->position = $position;

        return $this;
    }
}