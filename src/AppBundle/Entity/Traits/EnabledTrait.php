<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 21:53
 */

namespace AppBundle\Entity\Traits;

use AppBundle\Entity\Interfaces\EnabledInterface;

/**
 * EnabledTrait
 */
trait EnabledTrait
{
    /**
     * @var bool
     */
    private $enabled = true;

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