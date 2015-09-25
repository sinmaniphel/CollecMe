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

        $menu->addChild("my.page")
            ->setExtra('translation_domain','my');

        $menu->addChild("News");
        
        $colMenu = $menu->addChild("my.collections");
        $colMenu->setExtra('translation_domain','my');
        
        foreach($options['user.collections'] as $collection) {
            $colMenu->addChild($collection->name);
        }

        return menu;        
        
    }
}