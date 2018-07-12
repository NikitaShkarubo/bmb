<?php

namespace App\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;
use Doctrine\ORM\EntityManager;

class MenuBuilderListener {

    /** @var EntityManager $em */
    private $em;

    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('settings', [
            'label' => 'ADMIN_LABEL.SETTINGS',
            'route' => 'settings_edit',
            'routeParameters' => ['id' => 1],
        ])->setExtras([
            'icon' => '<i class="fa fa-gears"></i>',
        ]);

        $menu->addChild('users', [
            'label' => 'ADMIN_LABEL.USERS',
            'route' => 'admin_app_user_list',
        ])->setExtras([
            'icon' => '<i class="fa fa-users"></i>',
        ]);
    }
}