<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 06.09.2017
 * Time: 20:55
 */

namespace AppBundle\Entity\Traits;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * this trait replaces trait \Knp\DoctrineBehaviors\Model\Translatable\Translatable
 * override parameter knp.doctrine_behaviors.translatable_subscriber.translatable_trait: AppBundle\Entity\Traits\TranslatableTrait on file app\config\knp_doctrine_behaviors.yml
 *
 * TranslatableTrait
 */
trait TranslatableTrait
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->setCurrentLocale($locale);
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getCurrentLocale();
    }

}