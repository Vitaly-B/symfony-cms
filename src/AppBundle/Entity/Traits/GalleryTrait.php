<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 13.09.2017
 * Time: 4:33
 */

namespace AppBundle\Entity\Traits;

use Sonata\MediaBundle\Model\GalleryInterface as SonataGalleryInterface;

/**
 * GalleryTrait
 */
trait GalleryTrait
{
    /* @var Collection */
    private $gallery;

    /**
     * Get gallery
     *
     * @return SonataGalleryInterface|null
     */
    public function getGallery(): ?SonataGalleryInterface
    {
        return $this->gallery;
    }

    /**
     * Set gallery
     *
     * @param SonataGalleryInterface|null $gallery
     *
     * @return GalleryTrait
     */
    public function setGallery(?SonataGalleryInterface $gallery)
    {
        $this->gallery = $gallery;

        return $this;
    }
}