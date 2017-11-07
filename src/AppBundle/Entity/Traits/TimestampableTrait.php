<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 17:04
 */

namespace App\AppBundle\Entity\Traits;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

trait TimestampableTrait
{
    use ORMBehaviors\Timestampable\Timestampable;
}