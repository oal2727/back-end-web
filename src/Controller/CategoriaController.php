<?php

namespace App\Controller;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Doctrine\DBAL\Driver\Connection;

class CategoriaController extends AbstractController
{
    //falta prefix and group
     /**
    * list.
    * @Rest\Get("/api/v1/categoria")
    *
    * @return Response
    */
    public function index(Connection $connection): Response //good
    {
          $categorias = $connection->fetchAll('SELECT * FROM CATEGORIA');
          if(is_null($categorias)){
            return $this->json(["categorias"=>"vacio"]);
          }
          return $this->json(["categorias"=>$categorias]);

    }
    /**
    * create.
    * @Rest\Post("/api/v1/categoria")
    *
    * @return Response
    */
    public function create(Request $request) //good
    {
        $categoria = new Category();
        $categoria->setDescripcion($request->get("descripcion"));
        $em = $this->getDoctrine()->getManager(); 
        $em->persist($categoria); 
        $em->flush();
    	return $this->json(["categorias"=>$categoria]);
    }
     /**
    * update.
    * @Rest\Put("/api/v1/categoria/{idcategoria}")
    *
    * @return Response
    */
     //no funciona el metodo put
    public function updated(Request $request,$idcategoria){ //falta actualizar correctamente
        $em = $this->getDoctrine()->getManager(); //god
        $categoria = $em->getRepository(Category::class)->find(["id"=>$idcategoria]);
            if (!$categoria) {
                throw $this->createNotFoundException(
                    'No product found for id '.$idcategoria
                );
            }
            $categoria->setDescripcion($request->get("descripcion"));
            // $em->persist($categoria);
            $em->flush();
       	     return $this->json(["message"=>$categoria]);
    }
     /**
    * ListsallMovies.
    * @Rest\Delete("/api/v1/categoria/{id}")
    *
    * @return Response
    */
    public function delete($id){
        $categoria = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categoria);
        $entityManager->flush();
        return $this->json(["message"=>"delete post"]);
    }
}