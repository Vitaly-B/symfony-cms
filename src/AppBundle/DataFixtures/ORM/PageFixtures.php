<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 10:18
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Interfaces\PageInterface;
use AppBundle\Managers\PageManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

        /* @var ValidatorInterface $validator */
        $validator = $this->container->get('validator');

        /* @var array $fixtures */
        $fixtures = json_decode(file_get_contents(__DIR__.'/Fixtures/pages.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        foreach ($fixtures as $fixture) {

            /* @var PageInterface $page*/
            $page = $pageManager->createPage();

            $page->setEnabled(true);
            $page->setTitle($propertyAccessor->getValue($fixture, '[title]'));
            $page->setSeoTitle($propertyAccessor->getValue($fixture, '[seo_title]'));
            $page->setDescription($propertyAccessor->getValue($fixture, '[description]'));
            $page->setContent($propertyAccessor->getValue($fixture, '[content]'));

            $errors = $validator->validate($validator);

            if ($errors->count() == 0) {
                $pageManager->save($page);
            } else {
                throw new \Exception((string)$errors);
            }
        }
    }

}