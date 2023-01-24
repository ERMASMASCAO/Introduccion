<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;
use App\Service\ProductService;


class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductService $ProductService): Response
    {
        $products = $ProductService->getProducts();
        return $this->render('page/index.html.twig', compact('products'));    }

    #[Route('/empresa', name: 'empresa')]
    public function empresa(): Response
    {
        return $this->render('page/empresa.html.twig', []);
    }

    #[Route('/service', name: 'service')]
    public function service(): Response
    {
        return $this->render('page/service.html.twig', []);
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('registration/register.html.twig', []);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', []);
    }

    public function productTemplate(ManagerRegistry $doctrine): Response
    {
    $repository = $doctrine->getRepository(Product::class);
    $products = $repository->findAll();
    return $this->render('partials/_product.html.twig',compact('products'));
    }
}

