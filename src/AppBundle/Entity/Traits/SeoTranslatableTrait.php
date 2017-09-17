<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 0:47
 */

namespace AppBundle\Entity\Traits;

/**
 * EntitySeoTranslatableTrait
 */
trait SeoTranslatableTrait
{
    use SeoTrait;

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return SeoTranslatableTrait
     */
    public function setSeoTitle(?string $seoTitle)
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale()) {
            $this->translate($this->getCurrentLocale())->setSeoTitle($seoTitle);
        } else {
            $this->seoTitle = $seoTitle;
        }

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string|null
     */
    public function getSeoTitle(): ?string
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale() && $seoTitle = $this->translate($this->getCurrentLocale())->getSeoTitle()) {
            return $seoTitle;
        }
        return $this->seoTitle;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return SeoTranslatableTrait
     */
    public function setSeoKeywords(?string $seoKeywords)
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale()) {
            $this->translate($this->getCurrentLocale())->setSeoKeywords($seoKeywords);
        } else {
            $this->seoKeywords = $seoKeywords;
        }
        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string|null
     */
    public function getSeoKeywords(): ?string
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale() && $seoKeywords = $this->translate($this->getCurrentLocale())->getSeoKeywords()) {
            return $seoKeywords;
        }
        return $this->seoKeywords;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return SeoTranslatableTrait
     */
    public function setSeoDescription(?string $seoDescription)
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale()) {
            $this->translate($this->getCurrentLocale())->setSeoDescription($seoDescription);
        } else {
            $this->seoDescription = $seoDescription;
        }
        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string|null
     */
    public function getSeoDescription(): ?string
    {
        if($this->getCurrentLocale() !== $this->getDefaultLocale() && $seoDescription = $this->translate($this->getCurrentLocale())->getSeoDescription()) {
            return $seoDescription;
        }
        return $this->seoDescription;
    }
}