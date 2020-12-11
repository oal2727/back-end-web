<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Component\Routing\Annotation\Route;

class ManagmentController extends AbstractController
{
  //managment controller 
  /**
  * @Route("/products/{id}/count", methods="POST")
  */
 public function increaseFavoriteCount($id) //increment 
 {
     $product = $this->productRepository->find($id);
     if (! $product) {
         return new JsonResponse("Not found!", 404);
     }
     $product->setFavoriteCount($product->getFavoriteCount() + 1);
     $this->updateDatabase($product);
     
     return $this->response($product->getFavoriteCount());
 }
}
