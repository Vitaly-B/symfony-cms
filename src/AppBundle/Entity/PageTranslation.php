<?php

namespace App\AppBundle\Entity;

use App\AppBundle\Entity\Interfaces\TranslationInterface;

/**
 * PageTranslation
 */
class PageTranslation implements TranslationInterface
{
    use Traits\SeoTrait;
    use Traits\TranslationTrait;
    use Traits\PageTrait;
}
