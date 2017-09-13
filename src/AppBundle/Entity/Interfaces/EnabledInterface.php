<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 21:52
 */

namespace AppBundle\Entity\Interfaces;

/**
 * EnabledInterface
 */
interface EnabledInterface
{
    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return EnabledInterface
     */
    public function setEnabled(bool $enabled): EnabledInterface;

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled(): bool;
}