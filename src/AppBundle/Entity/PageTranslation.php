<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PageInterface;
use AppBundle\Entity\Interfaces\SeoInterface;
use AppBundle\Entity\Interfaces\TranslationInterface;

/**
 * PageTranslation
 */
class PageTranslation implements PageInterface,
    SeoInterface,
    TranslationInterface
{
    use Traits\SeoTrait;
    use Traits\TranslationTrait;

    /* @var int */
    protected $id;

    /* @var string */
    protected $title;

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
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
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
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
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
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
}
