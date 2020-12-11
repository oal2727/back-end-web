<?php

namespace App\Controller;
use App\Entity\Repartidor;
use App\Repository\RepartidorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;


class RepartidorController extends AbstractController
{
      private $repartidorRepository;
    public function __construct(RepartidorRepository $repartidorRepository)
    {
        $this->repartidorRepository=$repartidorRepository;
    }

    /**
    * list.
    * @Rest\Get("/api/v1/repartidor")
    *
    * @return Response
    */
    public function index(Connection $connection): Response
    {
          $repartidores = $connection->fetchAll('SELECT * FROM REPARTIDOR');
          return $this->json(["repartidores"=>$repartidores]);

    }
    /**
    * create.
    * @Rest\Post("/api/v1/repartidor")
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $repartidor = new Repartidor();


        $repartidor->setDni($request->get("dni"));
        $repartidor->setNombre($request->get("nombre"));
        $repartidor->setApellido($request->get("apellido"));
        $repartidor->setEstado("DISPONIBLE"); 
        $repartidorData = $this->repartidorRepository->findOneBy([ //work with where email
                'dni'=>$repartidor->getDni()
        ]);
        if($repartidorData){
            throw $this->createNotFoundException('El dni ya existe');
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($repartidor);
        $em->flush();
        return $this->json(["repartidor"=>$repartidor]);
    }
     /**
    * ListsallMovies.
    * @Rest\Delete("/api/v1/repartidor/{id}")
    *
    * @return Response
    */
    public function delete($id){
        $repartidor = $this->getDoctrine()->getRepository(Repartidor::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($repartidor);
        $entityManager->flush();
        return $this->json(["message"=>"delete post"]);
    }

}
