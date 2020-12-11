<?php

namespace App\Controller;
use App\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
// use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\DBAL\Driver\Connection;
use App\Repository\ClienteRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


//1)falta implementar prefijos en rutas
//2)recordar dar uso de middleware
class ClienteController extends AbstractController
{
    /**
     * @Route("/cliente", name="cliente")
     */
      private $session;
      private $clienteRepository;
      private $encoder;
    public function __construct(SessionInterface $session,ClienteRepository $clienteRepository,UserPasswordEncoderInterface $encoder)
    {
        $this->session = $session;
        $this->clienteRepository=$clienteRepository;
        $this->encoder=$encoder;
    }

    public function index(): Response
    {
        $correo = $this->session->get("correo");
        return $this->json(["correo es "=> $correo]);
    }
    
    public function create(Request $request,UserPasswordEncoderInterface $encoder)
    {
         $cliente = new Cliente();
          $plainPassword = $request->get('password');
          $cliente->setPassword($this->encoder->encodePassword($cliente,"hola"));
       return $this->json(["message"=>$cliente->getPassword()]);
    }
    //recordar dar uso de middleware
    public function crearUsuario(Request $request): Response
    {   
            // if($email=="jose@hotmail.com"){
            //     $this->session->set("correo",$correo);
            //     return $this->json(["message"=>"existe usuario"]);
            // }
            $cliente = new Cliente();
            $cliente->setId($request->get("codigo"));
            $cliente->setNombre($request->get("nombre"));
            $cliente->setApellido($request->get("apellido"));
            $cliente->setTelefono($request->get("telefono"));
            $cliente->setCorreo($request->get("correo"));
            // $cliente->setPassword($request->get("password"));
            //password encode
             // $encoded = $this->encoder->encodePassword($cliente, $request->get("password"));
            // $cliente->setPassword($encoded);
         // return $this->json(["message"=>$cliente->getPassword()]);

            $user = $this->clienteRepository->findOneBy([ //work with where email
                'correo'=>$cliente->getCorreo()
            ]);
            if(!is_null($user)){
                return $this->json(["message"=>"usuario existe"]);
            }
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($cliente);
            // $em->flush();
            return $this->json(["message"=>"correcto"]);
    }
    public function login(Request $request) : Response{
        $email = $request->get("email");
        if($email == "jose@hotmail.com"){
            $cliente = new Cliente();
            $cliente->setNombre("jose");
            $cliente->setCorreo("jose@hotmail.com");
              $this->session->set("cliente",$cliente);
               return $this->json(["message"=>"correcto"]);
        }
         return $this->json(["message"=>"incorrecto"]);
    }
    public function me(): Response{
        $datos = $this->session->get('cliente');
        return $this->json(["message"=>$datos]);
    }
    public function logout(): Response{
         $this->session->clear();
          return $this->json(["message"=>"datos cerrados"]);
    }   
    public function delete(): Response
    {
          
    }
    public function update(): Response
    {

    }
}
