<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:43
 */

namespace App\AppBundle\Entity\Interfaces;

use Sonata\MediaBundle\Model\GalleryInterface as SonataGalleryInterface;

/**
 * GalleryInterface
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