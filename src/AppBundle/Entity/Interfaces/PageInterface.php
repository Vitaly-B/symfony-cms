<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:25
 */

namespace App\AppBundle\Entity\Interfaces;

/**
 * PageInterface
 */
interface PageInterface extends IdentifierInterface, EnabledInterface, SeoInterface
{
    /**
     * Set title
     *
     * @param string|null $title
     *
     * @return PageInterface
     */
    public function setTitle(?string $title): PageInterface;

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Set description
     *
     * @param string|null $description
     *
     * @return PageInterface
     */
    public function setDescription(?string $description): PageInterface;

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Set content
     *
     * @param string|null $content
     *
     * @return PageInterface
     */
    public function setContent(?string $content): PageInterface;

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string;
}