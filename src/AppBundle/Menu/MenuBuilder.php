<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 15:04
 */

namespace AppBundle\Menu;

use AppBundle\Entity\ProductCategory;
use AppBundle\Managers\ProductCategoryManager;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class MenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param FactoryInterface $factory
     *
     * @return ItemInterface
     */
    public function createTopLeftMenu(FactoryInterface $factory): ItemInterface
    {
        $menu = $factory->createItem('top_left_menu');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');

        $menu->addChild('About', [
            'route'           => 'page',
            'routeParameters' => ['id' => 1 ],
        ])
             ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link')
        ;

        $menu->addChild('Shop', [
            'route'           => 'products_list'
        ])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link')
        ;

        $menu->addChild('Contact', [
            'route'           => 'page',
            'routeParameters' => ['id' => 3 ],
        ])
             ->setAttribute('class', 'nav-item')
             ->setLinkAttribute('class', 'nav-link')
        ;



        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     *
     * @return ItemInterface
     */
    public function createProductCategoriesMenu(FactoryInterface $factory): ItemInterface
    {
        $menu = $factory->createItem('products_category_menu');
        $menu->setChildrenAttribute('class', 'nav flex-column');

        /* @var ProductCategoryManager $productCategoryManager */
        $productCategoryManager = $this->container->get('app.product_category_manager');

        /* @var ProductCategory[] $productCategoryArr*/
        $productCategoryArr = $productCategoryManager->getCategoryHierarchy();

        /* @var ProductCategory[] $productCategoryArrIndexedByParentId */
        $productCategoryArrIndexedByParentId = [];
        foreach ($productCategoryArr as $productCategory) {

            /* @var ProductCategory $productCategory */
            $productCategoryArrIndexedByParentId[(int)$productCategory->getParentId()][] = $productCategory;
        }

        $this->createProductCategoriesMenuRecursive($productCategoryArrIndexedByParentId, $menu);

        return $menu;
    }

    /**
     * @param array $productCategoryArrIndexedByParentId
     * @param ItemInterface $menu
     * @param ProductCategory $parentProductCategory
     *
     * @return void
     */
    private function createProductCategoriesMenuRecursive(array & $productCategoryArrIndexedByParentId, ItemInterface $menu, ProductCategory $parentProductCategory = null)
    {
        $parentId = $parentProductCategory ? $parentProductCategory->getId() : 0;

        foreach ($productCategoryArrIndexedByParentId[$parentId] as $productCategory) {

            /* @var ProductCategory $productCategory */
            $menu->addChild(
                $productCategory->getTitle(),
                [
                    'route' => 'products_list',
                    'routeParameters' => [
                        'page'       => 1,
                        'categoryId' => $productCategory->getId(),
                    ],
                ]
            );

            $menu->getChild($productCategory->getTitle())
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link')
            ;

            if (isset($productCategoryArrIndexedByParentId[$productCategory->getId()])
                && ! empty($productCategoryArrIndexedByParentId[$productCategory->getId()])) {

                $this->createProductCategoriesMenuRecursive(
                    $productCategoryArrIndexedByParentId,
                    $menu->getChild($productCategory->getTitle()),
                    $productCategory
                );
            }
        }
    }
}