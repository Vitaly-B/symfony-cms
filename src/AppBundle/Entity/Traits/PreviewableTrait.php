<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 29.08.2017
 * Time: 16:23
 */

namespace AppBundle\Entity\Traits;

use AppBundle\Entity\Interfaces\PreviewableInterface;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * PreviewableTrait
 */
trait PreviewableTrait
{
    /**
     * @var MediaInterface
     */
    private $image;

    /**
     * @param MediaInterface|null $image
     *
     * @return PreviewableTrait
     */
    public function setImage(?MediaInterface $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return MediaInterface|null
     */
    public function getImage(): ?MediaInterface
    {
        return $this->image;
    }
}