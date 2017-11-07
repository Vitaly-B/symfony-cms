<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 23:21
 */

namespace App\AppBundle\Entity\Traits;

use App\AppBundle\Entity\Interfaces\PageInterface;

/**
 * PageTrait
 */
trait PageTrait
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
     * @param string|null $description
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
     * @param string|null $content
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