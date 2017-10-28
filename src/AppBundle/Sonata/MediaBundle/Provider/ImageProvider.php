<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 28.10.2017
 * Time: 0:18
 */

namespace AppBundle\Sonata\MediaBundle\Provider;

use Sonata\MediaBundle\Model\MediaInterface;

/**
 * FileProvider
 *
 * override base FileProvider - see more - parameters: sonata.media.provider.file.class from file app\config\sonata_media.yml
 */
class ImageProvider extends \Sonata\MediaBundle\Provider\ImageProvider
{
    /**
     * @param MediaInterface $media
     *
     * @return void
     */
    public function preRemove(MediaInterface $media)
    {
        $path = $this->getReferenceImage($media);

        if ($this->getFilesystem()->has($path)) {
            $this->getFilesystem()->delete($path);
        }

        if ($this->requireThumbnails()) {
            $this->thumbnail->delete($this, $media);
        }
    }

    /**
     * @param MediaInterface $media
     *
     * @return void
     */
    public function postRemove(MediaInterface $media)
    {
    }

    /**
     * @param MediaInterface $media
     *
     * @return void
     */
    public function postUpdate(MediaInterface $media)
    {
        if (!$media->getBinaryContent() instanceof \SplFileInfo) {
            return;
        }

        // Delete the current file from the FS
        $oldMedia = clone $media;
        // if no previous reference is provided, it prevents
        // Filesystem from trying to remove a directory
        if ($media->getPreviousProviderReference() !== null) {

            $oldMedia->setProviderReference($media->getPreviousProviderReference());

            $path = $this->getReferenceImage($oldMedia);

            if ($this->getFilesystem()->has($path)) {
                $this->getFilesystem()->delete($path);
                if ($this->requireThumbnails()) {
                    $this->thumbnail->delete($this, $media);
                }
            }
        }

        unset($oldMedia);
    }

}