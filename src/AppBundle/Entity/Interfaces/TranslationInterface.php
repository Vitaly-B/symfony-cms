<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 22:10
 */

namespace AppBundle\Entity\Interfaces;

/**
 * TranslationInterface
 *
 * implements default \AppBundle\Entity\Traits\TranslationTrait
 */
interface TranslationInterface
{
    public static function getTranslatableEntityClass();

    public function setTranslatable($translatable);

    public function getTranslatable();

    public function setLocale($locale);

    public function getLocale();

    public function isEmpty();

}