<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 10:18
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page;
use AppBundle\Managers\PageManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * PageFixtures
 */
class PageFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        /* @var PageManager $pageManager */
        $pageManager = $this->container->get('app.managers.page_manager');

        $validator = $this->container->get('validator');

        /* @var array $fixtures */
        //$fixtures = json_decode(file_get_contents(__DIR__.'/Fixtures/pages.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

//        foreach ($fixtures as $fixture) {
//
//        }
    }

}