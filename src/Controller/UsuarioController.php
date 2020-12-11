<?php

namespace App\Controller;
use App\Entity\Cliente;
use App\Entity\Administrador;
use App\Repository\ClienteRepository;
use App\Repository\AdministradorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;


//1)falta implementar prefijos en rutas
//2)recordar dar uso de middleware
class UsuarioController extends AbstractController
{

      private $session;
      private $clienteRepository;
      private $encoder;
      private $administradorRepository;
    public function __construct(SessionInterface $session,ClienteRepository $clienteRepository,UserPasswordEncoderInterface $encoder,AdministradorRepository $administradorRepository)
    {
        $this->session = $session;
        $this->clienteRepository=$clienteRepository;
        $this->encoder=$encoder;
        $this->administradorRepository=$administradorRepository;
    }

    /**
    * list.
    * @Rest\Post("/api/v1/usuario/cliente")
    *
    * @return Response
    */
    public function registerCliente(Request $request): Response
    {
        $cliente = new Cliente();
        $cliente->setNombre($request->get("nombre"));
        $cliente->setApellido($request->get("apellido"));
        $cliente->setTelefono($request->get("telefono"));
        $cliente->setCorreo($request->get("email"));
        $clienteData = $this->clienteRepository->findOneBy([ //work with where email
                'correo'=>$request->get("email")
        ]); 
        if($clienteData){
         throw $this->createNotFoundException('El Correo ya existe'); 
        }
        $cliente->setPassword($this->encoder->encodePassword($cliente,$request->get("password")));
        $em = $this->getDoctrine()->getManager();
        $em->persist($cliente);
        $em->flush();
        return $this->json(["password es "=> "cliente registrado correctamente"]);
    }
       /**
    * list.
    * @Rest\Post("/api/v1/usuario/administrador")
    *
    * @return Response
    */
    public function registerAdministrador(Request $request): Response
    {
        // $cliente = new Cliente();
        // $cliente->setPassword($this->encoder->encodePassword($cliente,$request->get("password")));
        // return $this->json(["password es "=> $cliente->getPassword()]);
        $administrador = new Administrador();
        $administrador->setNombre($request->get("nombre"));
        $administrador->setApellido($request->get("apellido"));
        $administrador->setUsername($request->get("username"));
        $administrador->setPassword($this->encoder->encodePassword($administrador,$request->get("password")));
        $em = $this->getDoctrine()->getManager();
        $em->persist($administrador);
        $em->flush();
        return $this->json(["password es "=> "administrador registrado correctamente"]);
    }
      /**
    * list.
    * @Rest\Post("/api/v1/usuario/cliente/login")
    *
    * @return Response
    */
    public function loginCliente(Request $request): Response
    {
        $cliente = new Cliente();
        $password = $request->get("password");
        $email = $request->get("email");
        if(is_null($email) || is_null($password)) {
              throw $this->createNotFoundException('Llenar Campos');
        }
        $clienteData = $this->clienteRepository->findOneBy([ //work with where email
                'correo'=>$email
        ]); 
        if(!$clienteData){
             throw $this->createNotFoundException('El Correo ingresado no existe'); 
        }
        $salt = $clienteData->getSalt();
        $passwordHash = $clienteData->getPassword();
        // $cliente->setPassword($)
        $verify = $this->encoder->isPasswordValid($clienteData,$password);
        if($verify){
            //generar json encode
            // $data = array('id'=>$clienteData->getIdCliente(),
            //     'nombre'=>$clienteData->getNombre(),
            //     'apellido'=>$clienteData->getApellido(),
            //     'rol'=>'Cliente');
           // $this->session->set('usuario',$data);
            return $this->json(["usuario"=> $clienteData]);
        }else{
                throw $this->createNotFoundException('La contraseña no coinciden'); 
        }
    }
      /**
    * list.
    * @Rest\Post("/api/v1/usuario/administrador/login")
    *
    * @return Response
    */
    public function loginAdministrador(Request $request): Response
    {
        $administrador = new Administrador();
        $password = $request->get("password");
        $username = $request->get("username");
        if(is_null($username) || is_null($password)) {
              throw $this->createNotFoundException('Llenar Campos');
        }
        $administradorData = $this->administradorRepository->findOneBy([ //work with where email
                'username'=>$username
        ]); 
        if(!$administradorData){
             throw $this->createNotFoundException('El Usuario ingresado no existe'); 
        }
        $salt = $administradorData->getSalt();
        $passwordHash = $administradorData->getPassword();
        $verify = $this->encoder->isPasswordValid($administradorData,$password);
        if($verify){
            //generar json encode
            $data = array('id'=>$administradorData->getId(),
                'nombre'=>$administradorData->getNombre(),
                'apellido'=>$administradorData->getApellido(),
                'rol'=>'Administrador');
           $this->session->set('usuario',$data);
            return $this->json(["usuario "=> $data]);
        }else{
         throw $this->createNotFoundException('La contraseña no coinciden'); 
        }

    }
     /**
    * list.
    * @Rest\Get("/api/v1/usuario/me")
    *
    * @return Response
    */
    public function Me()
    {
        $data = $this->session->get('usuario');
         return $this->json(["usuario"=> $data]);
    }
     /**
    * list.
    * @Rest\Post("/api/v1/usuario/logout")
    *
    * @return Response
    */
    public function logout(){
        $this->session->remove('usuario');
         return $this->json(["usuario"=> 'session finalizada']);
    }



}
