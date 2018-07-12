<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class PageRepository
 *
 * @package App\Repository
 */
class PageRepository extends EntityRepository
{
    /**
     * @param string $slug
     *
     * @return null|Page
     */
    public function getOneBySlug(string $slug): ?Page
    {
        try {
            return $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.active = :active')
                ->andWhere('p.slug  = :slug')
                ->setParameters([
                    'active' => true,
                    'slug'   => $slug
                ])
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param int $limit
     *
     * @return Page[]
     */
    public function getArticles($limit = null): array
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.active = :active')
            ->andWhere('p.type  =:type')
            ->setParameters([
                'active' => true,
                'type'   => Page::TYPE_ARTICLE
            ]);

            if (null != $limit) {
                $qb->setMaxResults($limit);
            }

            $qb->orderBy('p.id', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
