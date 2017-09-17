<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 14:15
 */

namespace AppBundle\Entity\Traits;


use AppBundle\Entity\Interfaces\SortableInterface;

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
     * @return SortableInterface
     */
    public function setPosition(?int $position): SortableInterface
    {
        $this->position = $position;

        return $this;
    }
}