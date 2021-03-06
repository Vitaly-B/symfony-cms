<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 21:53
 */

namespace App\AppBundle\Entity\Traits;

use App\AppBundle\Entity\Interfaces\EnabledInterface;

/**
 * EnabledTrait
 */
trait EnabledTrait
{
    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return EnabledInterface
     */
    public function setEnabled(bool $enabled): EnabledInterface
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

}