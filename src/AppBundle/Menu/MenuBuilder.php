<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 15:04
 */

namespace App\AppBundle\Menu;

use App\AppBundle\Entity\Page;
use App\AppBundle\Entity\ProductCategory;
use App\AppBundle\Managers\PageManager;
use App\AppBundle\Managers\ProductCategoryManager;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

/**
 * MenuBuilder
 */
class MenuBuilder
{
    /* @var FactoryInterface*/
    private $factory;

    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /* @var PageManager */
    private $pageManager;

    /**
     * @param FactoryInterface       $factory
     * @param ProductCategoryManager $productCategoryManager
     * @param PageManager            $pageManager
     *
     */
    public function __construct(FactoryInterface $factory, ProductCategoryManager $productCategoryManager, PageManager $pageManager)
    {
        $this->factory                = $factory;
        $this->productCategoryManager = $productCategoryManager;
        $this->pageManager            = $pageManager;
    }


    /**
     * @return ItemInterface
     */
    public function createTopLeftMenu(): ItemInterface
    {
        $menu = $this->factory->createItem('top_left_menu');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');

        foreach ($this->pageManager->getPages() as $page) {
            /* @var Page $page */
            $menu->addChild($page->getTitle(), [
                'route'           => 'page',
                'routeParameters' => ['id' => $page->getId() ],
            ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link')
            ;
        }

        $menu->addChild('Shop', [
            'route'           => 'products_list'
        ])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link')
        ;

        return $menu;
    }

    /**
     * @return ItemInterface
     */
    public function createProductCategoriesMenu(): ItemInterface
    {
        $menu =  $this->factory->createItem('products_category_menu');
        $menu->setChildrenAttribute('class', 'nav flex-column');

        /* @var ProductCategory[] $productCategoryArr*/
        $productCategoryArr = $this->productCategoryManager->getCategoryHierarchy();

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

        if(isset($productCategoryArrIndexedByParentId[$parentId])) {
            foreach ($productCategoryArrIndexedByParentId[$parentId] as
                $productCategory) {

                /* @var ProductCategory $productCategory */
                $menu->addChild(
                    $productCategory->getTitle(),
                    [
                        'route'           => 'products_list',
                        'routeParameters' => [
                            'page'       => 1,
                            'categoryId' => $productCategory->getId(),
                        ],
                    ]
                );

                $menu->getChild($productCategory->getTitle())
                    ->setAttribute('class', 'nav-item')
                    ->setLinkAttribute('class', 'nav-link');

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
}