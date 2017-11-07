<?php

namespace App\ExtendedSonataTranslationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExtendedSonataTranslationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataTranslationBundle';
    }
}
