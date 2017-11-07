<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 29.08.2017
 * Time: 16:23
 */

namespace App\AppBundle\Entity\Traits;

use App\AppBundle\Entity\Interfaces\PreviewableInterface;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * PreviewableTrait
 */
trait PreviewableTrait
{
    /**
     * @var MediaInterface
     */
    protected $image;

    /**
     * @param MediaInterface|null $image
     *
     * @return PreviewableInterface
     */
    public function setImage(?MediaInterface $image): PreviewableInterface
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