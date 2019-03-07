<?php

namespace App\Repository;

use App\Entity\FlightSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FlightSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlightSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlightSchedule[]    findAll()
 * @method FlightSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FlightSchedule::class);
    }

    // /**
    //  * @return FlightSchedule[] Returns an array of FlightSchedule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlightSchedule
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
