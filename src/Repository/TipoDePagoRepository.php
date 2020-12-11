<?php

namespace App\Repository;

use App\Entity\TipoDePago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoDePago|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoDePago|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoDePago[]    findAll()
 * @method TipoDePago[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoDePagoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoDePago::class);
    }

    // /**
    //  * @return TipoDePago[] Returns an array of TipoDePago objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoDePago
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
