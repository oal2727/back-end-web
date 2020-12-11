<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    // /**
    //  * @return Producto[] Returns an array of Producto objects
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
    public function findOneBySomeField($value): ?Producto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */ 
    //ORACLE WORKING WITH PACKAGE
    	public function listProductoInitial(): array
    {
             $conn = $this->getEntityManager()->getConnection();
            $sql = '
            SELECT codigo,nombre,descripcion,costo,imageurl from producto p inner join imagenproducto i on p.codigo=i.codigoproducto WHERE ESTADO=:ESTADO ORDER BY NOMBRE FETCH NEXT 4 ROWS ONLY
                ';
             $stmt = $conn->prepare($sql);
            $stmt->execute(['ESTADO' => 'ACTIVO']);
            return $stmt->fetchAllAssociative();
    }

     public function readCostProducto(): array
    {
             $conn = $this->getEntityManager()->getConnection();
            $sql = '
                BEGIN PK01.DEVUELVE_COSTO(:idorden); END;
                ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['idorden' => "PO004"]);
            // returns an array of arrays (i.e. a raw data set)
            return $stmt->fetchAllAssociative();
    }
}
