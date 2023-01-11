<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Team;
use App\Entity\Product;
use App\Services\ProductsService;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine, ProductsService $ProductsService): Response
    {
    $products = $ProductsService->getProducts();
    return $this->render('page/index.html.twig', compact('products'));
    }

    #[Route('/about', name: 'about')]
    public function about(ManagerRegistry $doctrine): Response
    {
    return $this->render('page/about.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', []);
    }

    #[Route('/price', name: 'price')]
    public function price(): Response
    {
        return $this->render('page/price.html.twig', []);
    }

    #[Route('/service', name: 'service')]
    public function service(): Response
    {
        return $this->render('page/service.html.twig', []);
    }

    #[Route('/team', name: 'team')]
    public function team(): Response
    {
        return $this->render('page/team.html.twig', []);
    }

    #[Route('/testimonial', name: 'testimonial')]
    public function testimonial(): Response
    {
        return $this->render('page/testimonial.html.twig', []);
    }

    public function teamTemplate(ManagerRegistry $doctrine): Response
    {
    $repository = $doctrine->getRepository(Team::class);
    $team = $repository->findAll();
    return $this->render('partials/_team.html.twig',compact('team'));
    }

    public function productTemplate(ManagerRegistry $doctrine): Response
    {
    $repository = $doctrine->getRepository(Product::class);
    $products = $repository->findAll();
    return $this->render('partials/_product.html.twig',compact('products'));
    }
    

}
