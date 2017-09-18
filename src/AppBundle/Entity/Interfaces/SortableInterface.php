<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 14:06
 */

namespace AppBundle\Entity\Interfaces;


interface SortableInterface
{
    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     * @return SortableTrait
     */
    public function setPosition(?int $position);
}