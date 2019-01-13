<?php

namespace BlogBundle\Repository;

use BlogBundle\Entity\Client;
use Doctrine\Common\Collections\Criteria;

/**
 * ClientRepository
 *
 * A client of BrownGirl company
 */
class ClientRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find clients by date range
     * @param \DateTime $createdAt
     * @param \DateTime $expiresAt
     * @return Client[]
     */
    public function findByDateRange(\DateTime $createdAt, \DateTime $expiresAt)
    {
        $parameters = [
            'createdAt' => $createdAt,
            'expiresAt' => $expiresAt,
        ];
        return $this->createQueryBuilder('client')
            ->andWhere('client.createdAt >= :createdAt')
            ->andWhere('client.expiresAt <= :expiresAt')
            ->setParameters($parameters)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function findVitaOrRogers()
    {
        $expr = Criteria::expr();
        $criteria = Criteria::create();
        $criteria->where(
            $expr->orX(
                $expr->eq('firstName', 'Vita'),
                $expr->eq('firstName', 'Rogers'),
                $expr->eq('firstName', 'Jordan')
            )
        );
        return $this->matching($criteria);
    }
}
