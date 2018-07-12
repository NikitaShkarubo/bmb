<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TeamRepository
 *
 * @package App\Repository
 */
class TeamRepository extends EntityRepository
{
    /**
     * @return null|array
     */
    public function getTeams(): ?array
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.active = :active')
            ->setParameters([
                'active' => true
            ])
            ->getQuery()
            ->getResult();
    }
}