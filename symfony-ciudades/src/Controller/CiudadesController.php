<?php

namespace App\Controller;

use App\Entity\Pais;
use App\Entity\Ciudades;
use ContainerKeMoKbe\getResponseService;
use Doctrine\ORM\Exception\RepositoryException;
use Doctrine\Persistence\ManagerRegistry;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\BrowserKit\Request;

class CiudadesController extends AbstractController
{
    /**
    * @Route("/ciudades/nuevo", name="nuevo_ciudad")
    */
    public function nuevo(ManagerRegistry $doctrine, Request $request){
        $ciudades=new Ciudades();

        $formulario = $this->createFormBuilder($ciudades)
            ->add('nombre', TextType::class)
            ->add('habitantes', TextType::class)
            ->add('alcalde', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->add('pais', EntityType::class, array(
                'class' => Pais::class,
                'choice_label' => 'nombre',))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
            $formulario->handleRequest($request);

            if($formulario->isSubmitted() && $formulario->isValid()){
                $ciudades = $formulario->getData();
                $entityManager = $doctrine->getManager();
                $entityManager -> persist($ciudades);
                $entityManager->flush();
                return $this -> redirectToRoute('ficha_ciudades', ["codigo" => $ciudades
                ->getId()]);
            }

            return $this->render('nuevo.html.twig', array(
                'formulario' => $formulario->createView()
        ));        
    }
    /**
    * @Route("/ciudades/editar/{codigo}", name="editar_ciudad", requirements = {"codigo"="\d+"})
    */
    public function editar(ManagerRegistry $doctrine, Request $request){
        $repositorio = $doctrine->getRepository(Ciudades::class);
        $ciudad = $repositorio->find($codigo);

        $formulario = $this->createFormBuilder($ciudad)
            ->add('nombre', TextType::class)
            ->add('habitantes', TextType::class)
            ->add('alcalde', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->add('pais', EntityType::class, array(
                'class' => Pais::class,
                'choice_label' => 'nombre',))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
            $formulario->handleRequest($request);

            if($formulario->isSubmitted() && $formulario->isValid()){
                $ciudades = $formulario->getData();
                $entityManager = $doctrine->getManager();
                $entityManager -> persist($ciudades);
                $entityManager->flush();
                return $this -> redirectToRoute('ficha_ciudades', ["codigo" => $ciudades
                ->getId()]);
            }

            return $this->render('nuevo.html.twig', array(
                'formulario' => $formulario->createView()
        ));        
    }

    /**
    *  @Route("/ciudades/insertar", name="insertar ciudades")
    */

    public function insertar (ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        foreach($this->ciudades as $c){
            $ciudad = new Ciudades();
            $ciudad->setNombre($c["nombre"]);
            $ciudad->setHabitantes($c["habitantes"]);
            $ciudad->setAlcalde($c["alcalde"]);
            $entityManager->persist ($ciudad);
        }
    try
    {
        $entityManager->flush();
        return new Response("ciudad Insertada"); 
    } catch (\Exception $e) {
        return new Response("Error insertando ciudades");
    }
    }

    /**
    *  @Route("/ciudades/insertarConPais", name="insertar_con_pais_ciudades")
    */
    public function insertarConPais (ManagerRegistry $doctrine): Response{
        $entityManager = $doctrine->getManager();
        $pais = new Pais();

        $pais->setNombre("España");
        $ciudades=new ciudades();

        $ciudades->setNombre("Inserción de prueba con pais");
        $ciudades->setHabitantes("6041654165");
        $ciudades->setAlcalde("Puig");

        $entityManager->persist ($pais);
        $entityManager->persist ($ciudades);
    
        $entityManager->flush();
        return $this->render('ficha_ciudad_.html-twig', [
            'ciudades'=>$ciudades
        ]);
    }

     /**
    *  @Route("/ciudades/insertarSinPais", name="insertar_sin_pais_ciudades")
    */
    public function insertarSinPais (ManagerRegistry $doctrine): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Pais::class);

        $pais = $repositorio->findOneBy(["nombre" => "España"]);

        $ciudades=new ciudades();

        $ciudades->setNombre("Inserción de prueba con pais");
        $ciudades->setHabitantes("6041654165");
        $ciudades->setAlcalde("Puig");
        $ciudades->setPais($pais);

        $entityManager->persist ($ciudades);
    
        $entityManager->flush();
        return $this->render('ficha_ciudad_.html-twig', [
            'ciudades'=>$ciudades
        ]);
    }  

    #[Route('/ciudades', name: 'app_ciudades')]
    public function index(): Response
    {
        return $this->render('ciudades/index.html.twig', [
            'controller_name' => 'CiudadesController',
        ]);
    }
    private $ciudades = [
        1 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        2 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        5 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        7 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        9 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],

    ];
        
    /**
     * @Route("/ciudades/buscar/{texto}", name="buscar_ciudades")
     */
    public function buscar(ManagerRegistry $doctrine, $texto): Response{
        $repositorio = $doctrine->getRepository(Ciudades::class);
        $ciudades = $repositorio->findByNombre($texto);
        return $this->render('lista:ciudades.html.twig',[
            'ciudades' => $ciudades
        ]);
    }   

        /**
        * @Route("/ciudades/{codigo}", name="ficha_ciudades")
        */

    public function ficha(ManagerRegistry $doctrine, $codigo): Response{
        $repositorio = $doctrine->getRepository(Ciudades::class);
        $ciudad = $repositorio->find($codigo);
        return $this->render('ficha_ciudades.html.twig', [
        'ciudades' => $ciudad
        ]);
    }
    /**
    * @Route("/ciudades/update/{id}/{nombre}", name="modificar_ciudad")
    */
    public function update (managerRegistry $doctrine, $id, $nombre): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Contacto::class);
        $ciudad = $repositorio->find($id);
        if ($ciudad) {
            $ciudad->setNombre($nombre);
            try
            {
                $entityManager->flush();
                return $this->render('ficha_ciudad.html.twig', [
                    'ciudad' => $ciudad
                ]);
            }catch (\Exception $e){
                return new Response("Error inserando objetos");
            }     
        }else
            return $this->render('ficha_ciudad.html.twig', [
                'ciudad' => null
            ]);
    }
    /**
    * @Route("/ciudades/update/{id}/{nombre}", name="modificar_contacto")
    */
    public function delete (managerRegistry $doctrine, $id, $nombre): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Contacto::class);
        $ciudad = $repositorio->find($id);
        if ($ciudad) {
            try
            {
                $entityManager->remove($ciudad);
                $entityManager->flush();
                return new Response("Ciudad eliminada");
            }catch (\Exception $e){
                return new Response("Error eliminando objetos");
            }     
        }else
            return $this->render('ficha_ciudad.html.twig', [
                'ciudad' => null
            ]);
    }
    
}

