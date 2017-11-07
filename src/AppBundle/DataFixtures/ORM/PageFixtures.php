<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 10:18
 */

namespace App\AppBundle\DataFixtures\ORM;

use App\AppBundle\Entity\Interfaces\PageInterface;
use App\AppBundle\Managers\PageManager;
use App\AppBundle\Utils\IdSetter;
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
    use Traits\ConfigTrait;

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
        $fixtures = json_decode(file_get_contents($this->getFixturesPath() . '/pages.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        foreach ($fixtures as $fixture) {

            /* @var PageInterface $page*/
            $page = $pageManager->createPage();

            if($propertyAccessor->getValue($fixture, '[id]')) {
                /* @var IdSetter $idSetter */
                $idSetter = $this->container->get('app.utils.id_setter');
                $idSetter->setId($propertyAccessor->getValue($fixture, '[id]'), $page, $pageManager->getEntityManager());
            }

            $page->setEnabled(true);
            $page->setTitle($propertyAccessor->getValue($fixture, '[title]'));
            $page->setSeoTitle($propertyAccessor->getValue($fixture, '[seo_title]'));
            $page->setDescription($propertyAccessor->getValue($fixture, '[description]'));
            $page->setContent($propertyAccessor->getValue($fixture, '[content]'));

            $errors = $validator->validate($page);

            if ($errors->count() == 0) {
                $pageManager->save($page);
            } else {
                throw new \Exception((string)$errors);
            }
        }
    }

}