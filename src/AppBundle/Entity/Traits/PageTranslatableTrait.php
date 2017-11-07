<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 23:23
 */

namespace App\AppBundle\Entity\Traits;

use App\AppBundle\Entity\Interfaces\PageInterface;

/**
 * PageTranslatableTrait
 */
trait PageTranslatableTrait
{
    use PagePropertiesTrait;

    /**
     * Set title
     *
     * @param string|null $title
     *
     * @return PageInterface
     */
    public function setTitle(?string $title): PageInterface
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale()) {
            $this->translate($this->getCurrentLocale())->setTitle($title);
        } else {
            $this->title = $title;
        }

        return $this;
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale() && $title = $this->translate($this->getCurrentLocale())->getTitle()) {
            return $title;
        }

        return $this->title;
    }

    /**
     * Set description
     *
     * @param string|null $description
     *
     * @return PageInterface
     */
    public function setDescription(?string $description): PageInterface
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale()) {
            $this->translate($this->getCurrentLocale())->setDescription($description);
        } else {
            $this->description = $description;
        }

        return $this;
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale() && $description = $this->translate($this->getCurrentLocale())->getDescription()) {
            return $this->translate($this->getCurrentLocale())->getDescription();
        }

        return $this->description;
    }


    /**
     * Set content
     *
     * @param string|null $content
     *
     * @return PageInterface
     */
    public function setContent(?string $content): PageInterface
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale()) {
            $this->translate($this->getCurrentLocale())->setContent($content);
        } else {
            $this->content = $content;
        }

        return $this;
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale() && $content = $this->translate($this->getCurrentLocale())->getContent()) {
            return $content;
        }

        return $this->content;
    }
}