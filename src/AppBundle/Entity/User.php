<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 28.08.2017
 * Time: 16:23
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    use Traits\PreviewableTrait;
    use Traits\TimestampableTrait;
}
