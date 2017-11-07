<?php

namespace App\ExtendedSonataAdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExtendedSonataAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataAdminBundle';
    }
}
