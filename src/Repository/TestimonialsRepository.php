<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TestimonialsRepository
 *
 * @package App\Repository
 */
class TestimonialsRepository extends EntityRepository
{
    /**
     * @return null|array
     */
    public function getTestimonials(): ?array
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.active = :active')
            ->setParameters([
                'active' => true
            ])
            ->orderBy('t.rank', 'ASC')
            ->getQuery()
            ->getResult();
    }
}