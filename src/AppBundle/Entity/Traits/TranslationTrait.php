<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 22:18
 */

namespace App\AppBundle\Entity\Traits;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Translation
 * this trait replaces trait \Knp\DoctrineBehaviors\Model\Translatable\Translation
 * override parameter knp.doctrine_behaviors.translatable_subscriber.translatable_trait: App\AppBundle\Entity\Traits\TranslationTrait on file App\AppBundle\config\knp_doctrine_behaviors.yml
 */
trait TranslationTrait
{
    use ORMBehaviors\Translatable\Translation;
}