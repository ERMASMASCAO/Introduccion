<?php

namespace App\Controller;

use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CiudadesController extends AbstractController
{
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
    public function buscar($texto): Response{
        $resultados= array_filter($this->ciudades,
        function ($ciudades) use ($texto){
            return strpos($ciudades["nombre"],$texto) !== FALSE;
        }
    );
    return $this->render('lista:ciudades.html.twig',[
        'ciudades' => $resultados
    ]);
}

    /**

* @Route("/contacto/{codigo}", name="ficha_contacto")

*/

    public function ficha($codigo): Response{
        //Si no existe el elemento con dicha clave devolvemos null
        $resultado = ($this->ciudades[$codigo] ?? null);
        return $this->render('ficha_ciudades.html.twig', [
        'ciudades' => $resultado
        ]);
    }
}

