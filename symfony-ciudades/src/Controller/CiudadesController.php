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
    /**
     * @Route("/ciudades/{codigo}", name= "ficha_ciudades")
     */
    public function ficha($codigo)
    {
        $resultado = ($this->ciudades[$codigo] ?? null);

        if($resultado){
            $html = "<ul>";
                $html .= "<li>" . $codigo . "</li>";
                $html .= "<li>" . $resultado['nombre'] ."</li>";
                $html .= "<li>" . $resultado['habitantes'] ."</li>";
                $html .= "<li>" . $resultado['alcalde'] ."</li>";
            $html .= "</ul>";
            return new Response("<html><body>$html</body>");
        }else
            return new Response("<html><body>Ciudades $codigo no encontrado</body>");
    }

    private $ciudades = [
        1 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        2 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        5 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        7 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],
        9 => ["nombre" => "Castellon", "habitantes" => "524142432", "alcalde" => "juan"],

    ];
    
    public function buscar($texto): Response{
        $resultados= array_filter($this->ciudades
        function ($ciudades) use ($texto){
            return strpos($ciudades["nombre"],$texto) !== FALSE;
        }
    );
    if (count($resultado)){
        $html = "ul>";
        foreach($resultados as $id => $resultado){
            $html .= "<li>" . $id . "</li>";
            $html .= "<li>" . $resultado['nombre'] ."</li>";
            $html .= "<li>" . $resultado['habitantes'] ."</li>";
            $html .= "<li>" . $resultado['alcalde'] ."</li>";
        }
        $html .= "</ul>";
        return new Response("<html><body>$html</body>");        

    }
    }
}
