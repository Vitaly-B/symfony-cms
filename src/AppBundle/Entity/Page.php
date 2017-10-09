<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PageInterface;
use AppBundle\Entity\Interfaces\TranslatableInterface;

/**
 * Page
 */
class Page implements TranslatableInterface, PageInterface
{
    use Traits\IdentifierTrait;
    use Traits\SeoTranslatableTrait;
    use Traits\PageTranslatableTrait;
    use Traits\TimestampableTrait;
    use Traits\TranslatableTrait;
    use Traits\EnabledTrait;

    /**
     * @return string
     */
    function __toString(): string
    {
        return $this->getId().':'.$this->getTitle();
    }
}
