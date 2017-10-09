<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:33
 */

namespace AppBundle\Entity\Interfaces;

use Sonata\MediaBundle\Model\MediaInterface;

/**
 * PreviewableInterface
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