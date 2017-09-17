<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 14:09
 */

namespace AppBundle\Entity\Interfaces;

/**
 * SortableInterface
 *
 * implements default AppBundle\Entity\Traits\SortableTrait
 */
interface SortableInterface
{
    /**
     * @param int|null $position
     * @return SortableInterface
     */
    public function setPosition(?int $position): SortableInterface;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;
}