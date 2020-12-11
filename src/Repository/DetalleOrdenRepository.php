<?php

namespace App\Repository;

use App\Entity\DetalleOrden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetalleOrden|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetalleOrden|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetalleOrden[]    findAll()
 * @method DetalleOrden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleOrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetalleOrden::class);
    }

    // /**
    //  * @return DetalleOrden[] Returns an array of DetalleOrden objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetalleOrden
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
