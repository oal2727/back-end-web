<?php

namespace App\Repository;

use App\Entity\AsignacionRepartidor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AsignacionRepartidor|null find($id, $lockMode = null, $lockVersion = null)
 * @method AsignacionRepartidor|null findOneBy(array $criteria, array $orderBy = null)
 * @method AsignacionRepartidor[]    findAll()
 * @method AsignacionRepartidor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsignacionRepartidorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AsignacionRepartidor::class);
    }

    // /**
    //  * @return AsignacionRepartidor[] Returns an array of AsignacionRepartidor objects
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
    public function findOneBySomeField($value): ?AsignacionRepartidor
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
