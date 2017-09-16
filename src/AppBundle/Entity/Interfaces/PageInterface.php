<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 13.09.2017
 * Time: 3:42
 */

namespace AppBundle\Entity\Interfaces;

/**
 * PageInterface
 */
interface PageInterface extends SeoInterface,
    TimestampableInterface,
    EnabledInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int;

    /**
     * Set title
     *
     * @param string $title
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
     * @param string $description
     *
     * @return PageInterface
     */
    public function setDescription(?string $description) : PageInterface;

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Set content
     *
     * @param string $content
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