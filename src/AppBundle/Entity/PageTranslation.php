<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\TranslationInterface;

/**
 * PageTranslation
 */
class PageTranslation implements TranslationInterface
{
    use Traits\SeoTrait;
    use Traits\TranslationTrait;
    use Traits\PageTrait;
}
