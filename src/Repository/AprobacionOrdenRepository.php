<?php

namespace App\Repository;

use App\Entity\AprobacionOrden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AprobacionOrden|null find($id, $lockMode = null, $lockVersion = null)
 * @method AprobacionOrden|null findOneBy(array $criteria, array $orderBy = null)
 * @method AprobacionOrden[]    findAll()
 * @method AprobacionOrden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AprobacionOrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AprobacionOrden::class);
    }

    // /**
    //  * @return AprobacionOrden[] Returns an array of AprobacionOrden objects
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
    public function findOneBySomeField($value): ?AprobacionOrden
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
