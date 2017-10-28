<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.10.2017
 * Time: 20:15
 */

namespace AppBundle\DataFixtures\ORM\Traits;

/**
 * ConfigTrait
 */
trait ConfigTrait
{
    /**
     * @return string
     */
    protected function getFixturesPath(): string
    {
        return __DIR__.'/../Fixtures';
    }
}