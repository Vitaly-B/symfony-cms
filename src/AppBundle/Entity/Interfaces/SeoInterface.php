<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:16
 */

namespace App\AppBundle\Entity\Interfaces;

/**
 * SeoInterface
 */
interface SeoInterface
{
    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return SeoInterface
     */
    public function setSeoTitle(?string $seoTitle): SeoInterface;

    /**
     * Get seoTitle
     *
     * @return string|null
     */
    public function getSeoTitle(): ?string;

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return SeoInterface
     */
    public function setSeoKeywords(?string $seoKeywords): SeoInterface;

    /**
     * Get seoKeywords
     *
     * @return string|null
     */
    public function getSeoKeywords(): ?string;

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return SeoInterface
     */
    public function setSeoDescription(?string $seoDescription): SeoInterface;

    /**
     * Get seoDescription
     *
     * @return string|null
     */
    public function getSeoDescription(): ?string;
}