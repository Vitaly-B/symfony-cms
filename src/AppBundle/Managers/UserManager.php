<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 08.10.2017
 * Time: 14:56
 */

namespace App\AppBundle\Managers;

use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * UserManager
 */
class UserManager extends BaseUserManager
{
    /**
     * @return void
     */
    public function flush(): void
    {
        $this->objectManager->flush();
    }
}