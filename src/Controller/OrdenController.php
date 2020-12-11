<?php

namespace App\Controller;
use App\Entity\Orden;
use App\Entity\Repartidor;
use App\Entity\AprobacionOrden;
use App\Entity\TipoDePago;
use App\Entity\AsignacionRepartidor;
use App\Entity\DetalleOrden;
use App\Repository\OrdenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;

class OrdenController extends AbstractController
{

    private $ordenRepository;
    public function __construct(OrdenRepository $ordenRepository){
        $this->ordenRepository=$ordenRepository;
    }
    /**
    * create.
    * @Rest\Post("/api/v1/orden")
    *
    * @return Response
    */
    // 1) CREAR REGISTRO PARA EL ORDEN
    public function createOrden(Request $request){
            $orden = new Orden();
            $orden->setIdOrden($request->get("idorden"));
            $orden->setEstado("EN ESPERA");
            $orden->setCostoTotal($request->get("costoTotal"));
            $orden->setCodigoCliente($request->get("codigoCliente"));
            $orden->setDireccionOrden($request->get("direccionOrden"));
            $orden->setIdTipoPago($request->get("tipopago"));
            $orden->setCodigoZonaReparto($request->get("codigozonareparto"));
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($orden); 
            $em->flush();
             return $this->json(["ORDEN"=>"agregado correctamente"]);
    }
        /**
    * create.
    * @Rest\Post("/api/v1/detalleorden")
    *
    * @return Response
    */
    //request->getContent() -> get all data request
    //get count daata => count($array)
    // 2) CREAR REGISTROS DE DETALLEORDEN 
    public function createDetalleOrden(Request $request){
       $content = $request->getContent();
       if (!empty($content)) {
         $params = json_decode($content, true);
             foreach ($params as $key) {
                $orden = new DetalleOrden();
                $orden->setIdOrden($key["idOrden"]);
                $orden->setCodigoProducto($key["CODIGO"]);
                $orden->setCantidad($key["cantidad"]);
                $orden->setImporte($key["importe"]);
                $em = $this->getDoctrine()->getManager(); 
                $em->persist($orden); 
                $em->flush();
             }
         return $this->json(["message"=>"register good "]);
        }
      
    }
     
    /**
    * registrar aprobacion de orden.
    * @Rest\Post("/api/v1/orden/state/process")
    *
    * @return Response
    */
    public function aprobacionOrden(Request $request){
            $aprobacion = new AprobacionOrden();
            $idorden = $request->get("idorden");
            $aprobacion->setIdAdministrador($request->get("idAdministrador"));
            $aprobacion->setIdOrden($idorden);
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($aprobacion); 
            $em->flush();
            if($aprobacion){
                $this->updatedState($idorden,"EN PROCESO");
            }
        return $this->json(["data"=>"agregado"]);
    }

      /**
    * registrar asignacion de repartidor .
    * @Rest\Post("/api/v1/orden/state/execution")
    *
    * @return Response
    */
    public function asignacionRepartidor(Request $request){
            $asignacion = new AsignacionRepartidor();
            $idorden = $request->get("idOrden");
            $idRepartidor = $request->get("idRepartidor");
            $asignacion->setIdAdministrador($request->get("idAdministrador"));
            $asignacion->setIdRepartidor($idRepartidor);
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($asignacion); 
            $em->flush();
            if($asignacion){
                $this->updatedState($idorden,"EN ENTREGA");
                $this->updateStateRepartidor($idRepartidor,"OCUPADO");
            }
        return $this->json(["data"=>"agregado"]);
    }

     /**
    * registrar asignacion de repartidor .
    * @Rest\Post("/api/v1/orden/state/finalize")
    *
    * @return Response
    */
    public function finalizarOrden(Request $request){
        $idOrden = $request->get("IDORDEN");
         $this->updateStateRepartidor("IDREPARTIDOR","DISPONIBLE");
         $this->updatedState($idOrden,"FINALIZADO");
         return $this->json(["data"=>"agregado"]);
    }

 
    /**
    * create.
    * @Rest\Get("/api/v1/detalle/orden/{id}")
    *
    * @return Response
    */
    public function findIdOrdenDetail($id)
    {
        $resultado = $this->ordenRepository->findOneOrdenDetail($id);
         return $this->json(["orden"=>$resultado]);
    }

    /**
    * ORDENES EN ESPERA => ESTADO "EN ESPERA".
    * @Rest\Get("/api/v1/orden")
    *
    * @return Response
    */
    public function ordenWaiting(){
     $productos = $this->ordenRepository->showDetailOrden();
        return $this->json(["productos"=>$productos]);
    }
      /**
    * ORDENES FINALIZDAS => ESTADO "EN PROCESO".
    * @Rest\Get("/api/v1/order/process")
    *
    * @return Response
    */
      public function ordenProcess()
      {
       $ordenesProcess=  $this->ordenRepository->stateProcessOrder();
         return $this->json(["ordenes"=>$ordenesProcess]);
    }
     /**
    * ORDENES EN ENTREGA => ESTADO "EN ENTREGA".
    * @Rest\Get("/api/v1/order/execution")
    *
    * @return Response
    */
    public function execeutionOrden(){
     $productos = $this->ordenRepository->stateExecutionOrder();
        return $this->json(["productos"=>$productos]);
    }
     /**
    * ORDENES FINALIZDAS => ESTADO "FINALIZADO".
    * @Rest\Get("/api/v1/order/finalize")
    *
    * @return Response
    */
      public function ordenFinalizado()
      {
       $ordenesFinalizadas=  $this->ordenRepository->stateFinalizeOrder();
         return $this->json(["ordenes"=>$ordenesFinalizadas]);
    }

     /**
    * ORDENES FINALIZDAS => ESTADO "FINALIZADO".
    * @Rest\Get("/api/v1/order/tipodepago")
    *
    * @return Response
    */
      public function listTipoPago(Connection $connection)
      {
         $tiposdepago = $connection->fetchAll('SELECT * FROM TIPODEPAGO');
        return $this->json(["tipodepago"=>$tiposdepago]);
    }



     /**
    * create.
    * @Rest\Get("/api/v1/zonadereparto")
    *
    * @return Response
    */
    public function deliveryZone(Connection $connection)
    {
        $zonadereparto = $connection->fetchAll('SELECT * FROM ZONADEREPARTO');
        return $this->json(["zonadereparto"=>$zonadereparto]);
    }


    public function updatedState($idOrden,$state){
        $em = $this->getDoctrine()->getManager(); //god
        $orden = $em->getRepository(Orden::class)->find(["idOrden"=>$idOrden]);
            if (!$orden) {
                throw $this->createNotFoundException(
                    'No product found for id '.$idOrden
                );
            }
            $orden->setEstado($state);
            $em->flush();
    }

    public function updateStateRepartidor($idRepartidor,$state){
        $em = $this->getDoctrine()->getManager(); //god
        $repartidor = $em->getRepository(Repartidor::class)->find(["id"=>$idRepartidor]);
            if (!$repartidor) {
                throw $this->createNotFoundException(
                    'No product found for id '.$idRepartidor
                );
            }
            $repartidor->setEstado($state);
            $em->flush();
    }

}   

