<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 15:02
 */

namespace App\AppBundle\DataFixtures\ORM;

use App\AppBundle\Entity\Interfaces\ProductCategoryInterface;
use App\AppBundle\Entity\Interfaces\ProductInterface;
use App\AppBundle\Entity\Interfaces\SortableInterface;
use App\AppBundle\Managers\ProductCategoryManager;
use App\AppBundle\Managers\ProductManager;
use App\AppBundle\Utils\IdSetter;
use App\ExtendedSonataMediaBundle\Entity\Gallery;
use App\ExtendedSonataMediaBundle\Entity\GalleryHasMedia;
use App\ExtendedSonataMediaBundle\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Entity\MediaManager;
/**
 * ProductFixtures
 */
class ProductFixtures extends Fixture
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

        /* @var ProductManager $productManager */
        $productManager = $this->container->get('app.managers.product_manager');

        /* @var ValidatorInterface $validator*/
        $validator = $this->container->get('validator');

        /* @var array $fixtures */
        $fixtures = json_decode(file_get_contents($this->getFixturesPath() . '/products.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        /* @var ProductCategoryInterface[] */
        $productCategories = $productCategoryManager->getCategoryHierarchy();


        foreach ($productCategories as $productCategory) {
            /* @var ProductCategoryInterface $productCategory */
            if($productCategory->getParent() !== null) {

                foreach ($fixtures as $fixture) {

                    /* @var ProductInterface $product */
                    $product = $productManager->createProduct();

                    if($propertyAccessor->getValue($fixture, '[id]')) {
                        /* @var IdSetter $idSetter */
                        $idSetter = $this->container->get('app.utils.id_setter');
                        $idSetter->setId($propertyAccessor->getValue($fixture, '[id]'), $product, $productManager->getEntityManager());

                        if($propertyAccessor->getValue($fixture, '[position]') && $product instanceof SortableInterface) {
                            $product->setPosition($propertyAccessor->getValue($fixture, '[position]'));
                        }
                    }

                    $product->setEnabled(true);
                    $product->setTitle($productCategory->getTitle() . ' - ' . $propertyAccessor->getValue($fixture, '[title]'));
                    $product->setSeoTitle($propertyAccessor->getValue($fixture, '[seo_title]'));
                    $product->setPrice($propertyAccessor->getValue($fixture, '[price]'));
                    $product->setDescription($propertyAccessor->getValue($fixture, '[description]'));
                    $product->setContent($propertyAccessor->getValue($fixture, '[content]'));
                    $product->addCategory($productCategory);

                    if($propertyAccessor->getValue($fixture, '[image]')) {

                        $media = new Media();

                        $media->setBinaryContent(
                            $this->getFixturesPath().'/'.
                            $propertyAccessor->getValue($fixture, '[image]')
                        );
                        $media->setContext('product');
                        $media->setProviderName('sonata.media.provider.image');

                        $product->setImage($media);
                    }

//                    if($propertyAccessor->getValue($fixture, '[gallery]') && is_array($propertyAccessor->getValue($fixture, '[gallery]'))) {
//
//                        $gallery = new Gallery();
//
//                        $product->setGallery($gallery);
//
//                        $gallery->setName($product->getTitle());
//                        $gallery->setContext('product');
//                        $gallery->setEnabled(true);
//
//                        foreach ($propertyAccessor->getValue($fixture, '[gallery]') as $galleryImagePath) {
//
//                            $media = new Media();
//
//                            $media->setBinaryContent($this->getFixturesPath().'/'. $galleryImagePath);
//                            $media->setContext('product');
//                            $media->setProviderName('sonata.media.provider.image');
//
//
//                            $galleryHasMedia = new GalleryHasMedia();
//                            $galleryHasMedia->setMedia($media);
//
//                            $gallery->addGalleryHasMedias($galleryHasMedia);
//                        }
//
//
//                    }

                    $errors = $validator->validate($product);

                    if ($errors->count() == 0) {
                        $productManager->save($product);
                    } else {
                        throw new \Exception((string)$errors);
                    }
                }
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