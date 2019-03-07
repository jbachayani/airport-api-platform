<?php

namespace App\Repository;

use App\Entity\PassengerHasFlight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PassengerHasFlight|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassengerHasFlight|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassengerHasFlight[]    findAll()
 * @method PassengerHasFlight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengerHasFlightRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PassengerHasFlight::class);
    }

    // /**
    //  * @return PassengerHasFlight[] Returns an array of PassengerHasFlight objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PassengerHasFlight
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
