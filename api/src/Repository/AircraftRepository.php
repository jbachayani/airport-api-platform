<?php

namespace App\Repository;

use App\Entity\Aircraft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aircraft|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aircraft|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aircraft[]    findAll()
 * @method Aircraft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AircraftRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aircraft::class);
    }

    // /**
    //  * @return Aircraft[] Returns an array of Aircraft objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aircraft
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
