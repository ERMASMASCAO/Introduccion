<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\Persistence\ManagerRegistry;


class PageController extends AbstractController
{
    //Esta es la ruta blog
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
    //Esta es la ruta about
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig', []);
    }
    //Esta es la ruta contact
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(ManagerRegistry $doctrine): Response
    {
        return $this->render('page/contact.html.twig', array());
    }
    
}
