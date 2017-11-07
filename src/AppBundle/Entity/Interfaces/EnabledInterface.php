<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:22
 */

namespace App\AppBundle\Entity\Interfaces;

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