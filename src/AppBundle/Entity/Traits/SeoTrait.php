<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 0:46
 */

namespace AppBundle\Entity\Traits;

use AppBundle\Entity\Interfaces\SeoInterface;

/**
 * EntitySeoTrait
 */
trait SeoTrait
{
    /**
     * @var string
     */
    private $seoTitle;

    /**
     * @var string
     */
    private $seoKeywords;

    /**
     * @var string
     */
    private $seoDescription;

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return SeoInterface
     */
    public function setSeoTitle(?string $seoTitle): SeoInterface
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string|null
     */
    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return SeoInterface
     */
    public function setSeoKeywords(?string $seoKeywords): SeoInterface
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string|null
     */
    public function getSeoKeywords(): ?string
    {
        return $this->seoKeywords;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return SeoInterface
     */
    public function setSeoDescription(?string $seoDescription): SeoInterface
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string|null
     */
    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }
}