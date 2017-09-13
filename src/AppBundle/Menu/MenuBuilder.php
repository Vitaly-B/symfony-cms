<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 15:04
 */

namespace AppBundle\Menu;

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
        $menu = $factory->createItem('top_menu');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');

        $menu->addChild('app.layout.top_menu.page1', [
            'route'           => 'page',
            'routeParameters' => ['id' => 1 ],
        ])
             ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link')
        ;

        $menu->addChild('app.layout.top_menu.page2', [
            'route'           => 'page',
            'routeParameters' => ['id' => 3 ],
        ])
             ->setAttribute('class', 'nav-item')
             ->setLinkAttribute('class', 'nav-link')
        ;

        $menu->addChild('app.layout.top_menu.page_catalog', [
            'route'           => 'catalog'
        ])
             ->setAttribute('class', 'nav-item')
             ->setLinkAttribute('class', 'nav-link')
        ;

        return $menu;
    }
}