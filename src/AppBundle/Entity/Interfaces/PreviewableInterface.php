<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 29.08.2017
 * Time: 16:11
 */

namespace AppBundle\Entity\Interfaces;

use Sonata\MediaBundle\Model\MediaInterface;

/**
 * PreviewableInterface
 *
 * implements default \AppBundle\Entity\Traits\PreviewableTrait
 */
interface PreviewableInterface
{
    /**
     * @param MediaInterface|null $image
     *
     * @return PreviewableInterface
     */
    public function setImage(?MediaInterface $image): PreviewableInterface;

    /**
     * @return MediaInterface|null
     */
    public function getImage(): ?MediaInterface;
}