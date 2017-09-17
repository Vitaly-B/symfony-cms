<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PageInterface;
use AppBundle\Entity\Interfaces\SeoInterface;
use AppBundle\Entity\Interfaces\TimestampableInterface;
use AppBundle\Entity\Interfaces\TranslatableInterface;
use AppBundle\Entity\Interfaces\EnabledInterface;

/**
 * Page
 */
class Page implements PageInterface,
    SeoInterface,
    TimestampableInterface,
    EnabledInterface,
    TranslatableInterface
{
    use Traits\SeoTranslatableTrait;
    use Traits\TimestampableTrait;
    use Traits\TranslatableTrait;
    use Traits\EnabledTrait;

    /* @var int */
    private $id;

    /* @var string */
    private $title;

    /* @var string */
    private $description;

    /* @var string */
    private $content;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
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
     * @param string $description
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
     * @param string $content
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

    /**
     * @return string
     */
    function __toString(): string
    {
        return $this->getId().':'.$this->getTitle();
    }
}
