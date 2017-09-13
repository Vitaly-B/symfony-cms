<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.09.2017
 * Time: 0:33
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ProductCategory;


class TMenuBuilder
{
    /* @var FactoryInterface */
    private $factory;

    /* @var ObjectManager */
    private $objectManager;

    /**
     * @param FactoryInterface $factory
     * @param ObjectManager $objectManager
     */
    public function __construct(FactoryInterface $factory, ObjectManager $objectManager)
    {
        $this->factory = $factory;
        $this->objectManager = $objectManager;
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     */
    public function createMenu(array $options = [])
    {
        $menu = $this->factory->createItem('CatalogMainMenu');

//        if(isset($options['attributes']) && is_array($options['attributes'])) {
//            foreach ($options['attributes'] as $attr => $value)
//                $menu->setChildrenAttribute($attr, $value);
//        }
//
//        $productCategoryArr = $this->container->get('doctrine.orm.entity_manager')
//                                              ->getRepository(ProductCategory::class)
//                                              ->getNodesHierarchyQuery()->getResult();
//
//        $productCategoryArrIndexed = [];
//        foreach ($productCategoryArr as $productCategory) {
//            /* @var ProductCategory $productCategory */
//            $productCategoryArrIndexed[(int)$productCategory->getParentId()][] = $productCategory;
//        }
//
//        $this->createMenuRecursive($productCategoryArrIndexed, $menu, $options);

        return $menu;
    }

    /**
     * @param $productCategoryArr $productCategoryArrIndexed[]
     * @param ItemInterface $menu
     * @param ProductCategory $parentProductCategory
     *
     * @return void
     */
    private function createMenuRecursive(array $productCategoryArrIndexed, ItemInterface $menu, array $options = [], ProductCategory $parentProductCategory = null)
    {
        $parentId = $parentProductCategory ? $parentProductCategory->getId() : 0;

        foreach ($productCategoryArrIndexed[$parentId] as $productCategory) {
            /* @var ItemInterface $menu */
            /* @var ProductCategory $productCategory */
            $menu->addChild(
                $productCategory->getTitle(),
                [
                    'route'           => 'catalog',
                    'routeParameters' => ['id' => $productCategory->getId()],
                ]
            );

            if (isset($productCategoryArrIndexed[$productCategory->getId()]) && !empty($productCategoryArrIndexed[$productCategory->getId()])) {
                $this->createMenuRecursive(
                    $productCategoryArrIndexed,
                    $menu->getChild($productCategory->getTitle()),
                    $options,
                    $productCategory
                );
            }
        }
    }

}