<?php

namespace App\Repository;

use App\Entity\HistoryFlight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HistoryFlight|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoryFlight|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoryFlight[]    findAll()
 * @method HistoryFlight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryFlightRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HistoryFlight::class);
    }

    // /**
    //  * @return HistoryFlight[] Returns an array of HistoryFlight objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoryFlight
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
