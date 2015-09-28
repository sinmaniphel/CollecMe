<?php

namespace CollecMe\CollectionBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RequestStack;

class NavMenuBuilder extends ContainerAware
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }


    
    public function createNavMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild("my.page",array('route' => 'homepage'))
            ->setExtra('translation_domain','my');

        $menu->addChild("News",array('route' => 'route_item_list'));

        $menu->addChild("my.collections",
                        array('route' => 'route_item_list'))
             ->setExtra('translation_domain','my');
        if(isset($options['user.collections'])) {
            foreach($options['user.collections'] as $collection) {
                $menu['my.collections']->addChild($collection->name,array('route' => 'homepage'));
            }
        }
        dump($menu);
        return $menu;

    }
}