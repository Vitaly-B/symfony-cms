<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 10.09.2017
 * Time: 22:18
 */

namespace AppBundle\Entity\Traits;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Translation
 * this trait replaces trait \Knp\DoctrineBehaviors\Model\Translatable\Translation
 * override parameter knp.doctrine_behaviors.translatable_subscriber.translatable_trait: AppBundle\Entity\Traits\TranslationTrait on file app\config\knp_doctrine_behaviors.yml
 */
trait TranslationTrait
{
    use ORMBehaviors\Translatable\Translation;
}