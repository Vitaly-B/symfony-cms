<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 13.09.2017
 * Time: 4:33
 */

namespace AppBundle\Entity\Traits;

use Sonata\MediaBundle\Model\GalleryInterface as SonataGalleryInterface;
use AppBundle\Entity\Interfaces\GalleryInterface;

/**
 * GalleryTrait
 */
trait GalleryTrait
{
    /* @var Collection */
    protected $gallery;

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
     * @return GalleryInterface
     */
    public function setGallery(?SonataGalleryInterface $gallery): GalleryInterface
    {
        $this->gallery = $gallery;

        return $this;
    }
}