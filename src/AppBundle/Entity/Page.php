<?php

namespace App\AppBundle\Entity;

use App\AppBundle\Entity\Interfaces\PageInterface;
use App\AppBundle\Entity\Interfaces\TimestampableInterface;
use App\AppBundle\Entity\Interfaces\TranslatableInterface;

/**
 * Page
 */
class Page implements TranslatableInterface, PageInterface,
    TimestampableInterface
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
