<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Cocur\Slugify\Slugify;
use App\Entity\Page;

class PageListener
{
    /**
     * @param Page               $entity
     * @param LifecycleEventArgs $args
     */
    public function prePersist(Page $entity, LifecycleEventArgs $args): void
    {
        if (null === $entity->getSlug()) {
            $slugify = new Slugify();
            $entity->setSlug($slugify->slugify($entity->getPageTitle()));
        }
    }

    /**
     * @param Page               $entity
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(Page $entity, LifecycleEventArgs $args)
    {
        if ($entity->getType() !== Page::TYPE_SYSTEM) {
            if (null === $entity->getSlug()) {
                $slugify = new Slugify();
                $entity->setSlug($slugify->slugify($entity->getPageTitle()));
            }
        }
    }
}
