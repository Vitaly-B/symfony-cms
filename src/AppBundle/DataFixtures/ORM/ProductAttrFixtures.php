<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.10.2017
 * Time: 19:01
 */

namespace App\AppBundle\DataFixtures\ORM;

use App\AppBundle\Entity\Interfaces\ProductAttrInterface;
use App\AppBundle\Entity\Interfaces\ProductCategoryInterface;
use App\AppBundle\Managers\ProductAttrManager;
use App\AppBundle\Managers\ProductCategoryManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * ProductAttrFixtures
 */
class ProductAttrFixtures extends Fixture
{
    use Traits\ConfigTrait;

    /**
     * @param ObjectManager $manager
     *
     * @return void
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        /* @var ProductAttrManager $productAttrManager */
        $productAttrManager = $this->container->get('app.managers.product_attribute_manager');

        /* @var ProductCategoryManager $productCategoryManager */
        $productCategoryManager = $this->container->get('app.managers.product_category_manager');

        /* @var ValidatorInterface $validator*/
        $validator = $this->container->get('validator');


        /* @var array $fixtures */
        $fixtures = json_decode(file_get_contents($this->getFixturesPath() . '/product_attributes.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        /* @var ProductCategoryInterface[] */
        $productCategories = $productCategoryManager->getCategoryHierarchy();

        foreach ($fixtures as $fixture) {

            /* @var ProductAttrInterface $product */
            $attribute = $productAttrManager->createAttribute();
            $attribute->setTitle($propertyAccessor->getValue($fixture, '[title]'));
            $attribute->setType($propertyAccessor->getValue($fixture, '[type]'));

            /* @var ProductCategoryInterface $productCategory */
            $productCategory = $productCategories[rand(0, count($productCategories) - 1)];

            $attribute->addCategory($productCategory);

            $errors = $validator->validate($attribute);

            if ($errors->count() == 0) {
                $productAttrManager->save($attribute);
            } else {
                throw new \Exception((string)$errors);
            }

        }
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return array_merge(parent::getDependencies(),[
            ProductCategoryFixtures::class
        ]);
    }
}