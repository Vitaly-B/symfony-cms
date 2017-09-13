<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 0:15
 */

namespace AppBundle\Entity\Interfaces;

use Sonata\TranslationBundle\Model\TranslatableInterface as BaseTranslatableInterface;

/**
 * TranslatableInterface
 *
 * implements default \AppBundle\Entity\Traits\TranslatableTrait
 */
interface TranslatableInterface extends BaseTranslatableInterface
{
    public function getTranslations();

    public function getNewTranslations();

    public function addTranslation($translation);

    public function removeTranslation($translation);

    public function translate($locale = null, $fallbackToDefault = true);

    public function mergeNewTranslations();

    public function setCurrentLocale($locale);

    public function getCurrentLocale();

    public function setDefaultLocale($locale);

    public function getDefaultLocale();

    public static function getTranslationEntityClass();
}