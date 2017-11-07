<?php

namespace App\ExtendedFOSUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * FOSUserBundle
 *
 */
class ExtendedFOSUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
