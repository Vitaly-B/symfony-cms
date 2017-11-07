<?php

namespace App\ExtendedSonataDoctrineORMAdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * ExtendedSonataDoctrineORMAdminBundle
 */
class ExtendedSonataDoctrineORMAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataDoctrineORMAdminBundle';
    }

}
