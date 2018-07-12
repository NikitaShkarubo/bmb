<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class MenuRepository
 *
 * @package App\Repository
 */
class MenuRepository extends EntityRepository
{
    /**
     * @return Menu[]
     */
    public function getMenu(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.active = :active')
            ->andWhere('m.parentMenu IS NULL')
            ->setParameters([
                'active' => true
            ])
            ->orderBy('m.rank', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
