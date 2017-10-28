<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 13:58
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Managers\ProductCategoryManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * ProductCategoryFixtures
 */
class ProductCategoryFixtures extends Fixture
{
    use Traits\ConfigTrait;

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        /* @var ProductCategoryManager $productCategoryManager */
        $productCategoryManager = $this->container->get('app.managers.product_category_manager');

        /* @var ValidatorInterface $validator*/
        $validator = $this->container->get('validator');

        /* @var array $fixtures */
        $fixtures = json_decode(file_get_contents($this->getFixturesPath() . '/product_categories.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $needFlush = $this->loadRecursive($fixtures, $propertyAccessor, $productCategoryManager, $validator);

        if($needFlush) {
            $productCategoryManager->flush();
        }
    }

    /**
     * @param array                         $fixtures
     * @param PropertyAccessor              $propertyAccessor
     * @param ProductCategoryManager        $productCategoryManager
     * @param ValidatorInterface            $validator
     * @param ProductCategoryInterface|null $productCategoryParent
     *
     * @return bool
     *
     * @throws \Exception
     */
    protected function loadRecursive(
        array $fixtures,
        PropertyAccessor $propertyAccessor,
        ProductCategoryManager $productCategoryManager,
        ValidatorInterface $validator,
        ?ProductCategoryInterface $productCategoryParent = null
    ): bool
    {
        static $needFlush = false;

        foreach ($fixtures as $fixture) {

            /* @var ProductCategoryInterface $productCategory */
            $productCategory = $productCategoryManager->createProductCategory();
            $productCategory->setTitle($propertyAccessor->getValue($fixture, '[title]'));

            if($productCategoryParent !== null) {
                $productCategory->setParent($productCategoryParent);
            }

            $children = $propertyAccessor->getValue($fixture, '[children]');

            $errors = $validator->validate($productCategory);

            if ($errors->count() == 0) {
                $productCategoryManager->save($productCategory, false);
                $needFlush = true;
            } else {
                throw new \Exception((string)$errors);
            }

            if($children && is_array($children)) {
                $this->loadRecursive($children, $propertyAccessor, $productCategoryManager, $validator, $productCategory);
            }
        }

        return $needFlush;
    }
}