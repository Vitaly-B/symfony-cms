<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 13.09.2017
 * Time: 4:29
 */

namespace AppBundle\Entity\Interfaces;

use Sonata\MediaBundle\Model\GalleryInterface as SonataGalleryInterface;

/**
 * GalleryInterface
 *
 * base implements AppBundle\Entity\Traits\GalleryTrait
 */
interface GalleryInterface
{
    /**
     * Get gallery
     *
     * @return SonataGalleryInterface|null
     */
    public function getGallery(): ?SonataGalleryInterface;

    /**
     * Set gallery
     *
     * @param SonataGalleryInterface|null $gallery
     *
     * @return GalleryInterface
     */
    public function setGallery(?SonataGalleryInterface $gallery): GalleryInterface;
}