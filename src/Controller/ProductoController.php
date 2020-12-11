<?php

namespace App\Controller;
use App\Entity\Producto;
use App\Entity\ImagenProducto;
use App\Services\ImageUploader;
use App\Repository\ProductoRepository;
use App\Repository\ImagenProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;
use FOS\RestBundle\Controller\FOSRestController;

class ProductoController extends AbstractController
{


  private $imageUploader;
  private $productoRepository;
  private $imagenProducto;
  public function __construct(ImageUploader $imageUploader,
    ImagenProductoRepository $imagenProducto,
    ProductoRepository $productoRepository){
    $this->imageUploader=$imageUploader;
    $this->productoRepository=$productoRepository;
    $this->imagenProducto=$imagenProducto;
  }


  
  /**
    * create.
    * @Rest\Get("/api/v1/list/producto")
    *
  */
  public function listProductoRead(){
    $res = $this->productoRepository->readCostProducto();
    return $this->json(["resultado"=>$res]);

  } 
   /**
    * create.
    * @Rest\Get("/api/v1/producto/initial")
    *
    */
    public function listProductoInitial(){
        $productos = $this->productoRepository->listProductoInitial();
        return $this->json(["productos"=>$productos]);
    }
     /**
    * create.
    * @Rest\Get("/api/v1/producto")
    *
    */
     //uso de vistas xd
    public function listProducto(Connection $connection){
         $productos = $connection->fetchAll('SELECT * FROM detalleproducto');
        return $this->json(["productos"=>$productos]);
    }
      /**
    * create.
    * @Rest\Post("/api/v1/producto")
    *
    * @return Response
    */

      //problema actual por definir como double en el "costo" en back-end or front-en
    //GUARDAR PRODUCTO 
    public function createProducto(Request $request){
         $producto = new Producto();
           $imagenProducto = new ImagenProducto();
         $codigo = $request->get("codigo");
         $producto->setCodigo($request->get("codigo"));
         $producto->setNombre($request->get("nombre"));
         $producto->setDescripcion($request->get("descripcion"));
         $producto->setStock($request->get("stock"));
         $producto->setCosto($request->get("costo"));
         $producto->setEstado("Activo");
         $producto->setIdCategoria($request->get("idCategoria"));
          $em = $this->getDoctrine()->getManager();
          $em->persist($producto);
          $em->flush();
          if($producto){
           // $file = $request->files->get("imagen");
           // $imagenProducto = $this->uploadImagen($file,$codigo);
            $file = $request->files->get("imagen");
            $cloudinaryFile = $this->imageUploader->uploadImageToCloudinary($file);
            $imageUrl = $cloudinaryFile["secure_url"];
            $imageId= $cloudinaryFile["public_id"];
            $imagenProducto->setId($imageId);
            $imagenProducto->setImageUrl($imageUrl);
            $imagenProducto->setCodigoProducto($producto->getCodigo());
             $em = $this->getDoctrine()->getManager();
             $em->persist($imagenProducto);
             $em->flush();
             $arrayName = array('producto' => $producto,'imagen'=>$imagenProducto );
              return $this->json(["producto"=>$arrayName]);
          }else{
             return $this->json(["message"=>"Problema al agregar Producto"]);
          }
      
    }
    //GUARDAR IMAGEN 
    public function uploadImagen($file,$codigo):  array
    {
          $imagenProducto = new ImagenProducto();
        $cloudinaryFile = $this->imageUploader->uploadImageToCloudinary($file);
            $imageUrl = $cloudinaryFile["secure_url"];
             $imageId= $cloudinaryFile["public_id"];
             $imagenProducto->setId($imageId);
             $imagenProducto->setImageUrl($imageUrl);
             $imagenProducto->setCodigoProducto($codigo);
            $em = $this->getDoctrine()->getManager();
            $em->persist($imagenProducto);
            $em->flush();
            return $imagenProducto;
    }


    /**
    * create.
    * @Rest\Post("/api/v1/producto/{codigo}")
    *
    * @return Response
    */
    //put data on formdata bugs ...

    //UPDATE PRODUCTO 
    public function updateProduct(Request $request,$codigo){


         $em = $this->getDoctrine()->getManager(); //god
          $producto = $em->getRepository(Producto::class)->find($codigo);
            if (!$producto) {
                throw $this->createNotFoundException(
                    'No product found for codigo '.$codigo
                );
            }
            deleteImagen($codigo); //delete register imagenproducto
            $producto->setNombre($request->get("nombre"));
            $producto->setDescripcion($request->get("descripcion"));
           $producto->setStock($request->get("stock"));
           $producto->setCosto($request->get("costo"));
           $producto->setEstado($request->get("estado"));
           $producto->setIdCategoria($request->get("idCategoria"));
           if($producto){
              $file = $request->files->get("imagen");
              $imagen =  uploadImagen($file,);
               updateImagen();
           }
          
            $em->flush();
            return $this->json(["message"=>$producto]);
    }
    //UPDATE IMAGEN 
    // public function updateImagen($id){
    //       $em = $this->getDoctrine()->getManager(); //god
    //       $imagenProducto = $em->getRepository(ImagenProducto::class)->find($id);
    //         if (!$imagenProducto) {
    //             throw $this->createNotFoundException(
    //                 'No product found for codigo '.$id
    //             );
    //         }
    //         $imagenProducto->setImageUrl()
    // }

     /**
    * change state producto.
    * @Rest\Put("/api/v1/producto/state/{codigo}")
    *
    * @return Response
    */
    public function changeState(Request $request,$codigo){
          $em = $this->getDoctrine()->getManager(); //god
          $producto = $em->getRepository(Producto::class)->find($codigo);
            if (!$producto) {
                throw $this->createNotFoundException(
                    'No product found for codigo '.$codigo
                );
            }
            $producto->setEstado($request->get("estado"));
            $em->flush();
             return $this->json(["message"=>"actualizando estado"]);
    }
   /**
    * Delete Producto.
    * @Rest\Delete("/api/v1/producto/{id}")
    *
    * @return Response
    */
    public function delete($id){
         $entityManager = $this->getDoctrine()->getManager();
       $imagenProducto = $entityManager->getRepository(ImagenProducto::class)->findOneBy(["codigoProducto"=>$id]);
        // deleteImagen($id);
        $producto = $this->getDoctrine()->getRepository(Producto::class)->find($id);
        $entityManager->remove($producto);
        $entityManager->flush();
        $this->imageUploader->removeImageToCloudinary($imagenProducto->getId());
        return $this->json(["message"=>"eliminado correctamente"]);
    }
    // public function deleteImagen($codigo){
    //     $entityManager = $this->getDoctrine()->getManager();
    //      $imagenProducto = $entityManager->getRepository(ImagenProducto::class)->findOneBy(["codigoProducto"=>$codigo]);
    //       $this->imageUploader->removeImageToCloudinary($imagenProducto->getId());
    // }






    
}
