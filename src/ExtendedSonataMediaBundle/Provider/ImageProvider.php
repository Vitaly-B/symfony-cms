<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 28.10.2017
 * Time: 0:18
 */

namespace App\ExtendedSonataMediaBundle\Provider;

use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\ImageProvider as BaseImageProvider;

/**
 * ImageProvider
 *
 * override base FileProvider - see more - parameters: sonata.media.provider.file.class from file config\packages\sonata_media.yaml
 */
class ImageProvider extends BaseImageProvider
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
            }

            if ($this->requireThumbnails()) {
                $this->thumbnail->delete($this, $media);
            }
        }

        $this->fixBinaryContent($media);

        $this->setFileContents($media);

        $this->generateThumbnails($media);

        $media->resetBinaryContent();

        unset($oldMedia);
    }

}