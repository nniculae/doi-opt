<?php

namespace BlogBundle\Repository;

use BlogBundle\Entity\Client;

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
}
