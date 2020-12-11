<?php

namespace App\Repository;

use App\Entity\Orden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Orden|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orden|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orden[]    findAll()
 * @method Orden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orden::class);
    }

    // /**
    //  * @return Orden[] Returns an array of Orden objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function showDetailOrden() : array
    {
          $conn = $this->getEntityManager()->getConnection();
           $sqlfinalize = 'SELECT IDORDEN,NOMBRE,APELLIDO,ESTADO,FECHAORDEN FROM CLIENTE INNER JOIN ORDEN ON CLIENTE.CODIGO=ORDEN.CODIGOCLIENTE where estado=:ESTADO';
            $stmt = $conn->prepare($sqlfinalize);
            $stmt->execute(['ESTADO' => 'EN ESPERA']);
            return $stmt->fetchAllAssociative();
    }

    public function stateFinalizeOrder(): array
    {
            $conn = $this->getEntityManager()->getConnection();
           $sqlfinalize = 'SELECT orden.idorden,cliente.nombre,cliente.apellido,costoTotal,descripcion as TipoDePago from orden inner join cliente on orden.codigocliente=cliente.codigo inner join tipodepago on orden.idtipopago=tipodepago.idtipopago where estado=:ESTADO';
            $stmt = $conn->prepare($sqlfinalize);
            $stmt->execute(['ESTADO' => 'FINALIZADO']);
            return $stmt->fetchAllAssociative();
    }
      public function stateExecutionOrder(): array
    {
            $conn = $this->getEntityManager()->getConnection();
           $sqlfinalize = 'SELECT * FROM detalleEjecucionOrden where estado=:ESTADO';
            $stmt = $conn->prepare($sqlfinalize);
            $stmt->execute(['ESTADO' => 'EN ENTREGA']);
            return $stmt->fetchAllAssociative();
    }
    public function stateProcessOrder(): array
    {
         $conn = $this->getEntityManager()->getConnection();
           $sqlfinalize = 'SELECT orden.idorden,cliente.codigo,cliente.nombre,cliente.apellido,telefono,direccionOrden,zonadereparto.nombre as NombreDeEnvio,costoAdicional as CostoAdicional,costoTotal from orden inner join cliente on orden.codigocliente=cliente.codigo inner join tipodepago on orden.idtipopago=tipodepago.idtipopago inner join zonadereparto on orden.codigozonareparto=zonadereparto.codigopostal where estado=:ESTADO';
            $stmt = $conn->prepare($sqlfinalize);
            $stmt->execute(['ESTADO' => 'EN PROCESO']);
            return $stmt->fetchAllAssociative();
    }
    public function findOneOrdenDetail($id): array
    {
         $conn = $this->getEntityManager()->getConnection();
            $sql = '
                SELECT * FROM DETALLEPEDIDO
                WHERE idorden=:idorden
                ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['idorden' => $id]);
            // returns an array of arrays (i.e. a raw data set)
            return $stmt->fetchAllAssociative();
    }
    
}
