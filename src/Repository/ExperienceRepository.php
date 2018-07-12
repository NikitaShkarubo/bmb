<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class PortfolioRepository
 *
 * @package App\Repository
 */
class ExperienceRepository extends EntityRepository
{
    /**
     * @return null|array
     */
    public function getExperience(): ?array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.active = :active')
            ->setParameters([
                'active' => true
            ])
            ->orderBy('p.rank', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
