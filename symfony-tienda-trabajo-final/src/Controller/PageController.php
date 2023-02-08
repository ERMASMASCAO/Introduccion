<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;
use App\Service\ProductService;


class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductService $ProductService,ManagerRegistry $doctrine): Response
    {
        
        $products = $ProductService->getProducts();

        $repository = $doctrine->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('page/index.html.twig', compact('products', 'categories'));    }

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
    public function productCategoryTemplate($category, ManagerRegistry $doctrine): Response
    {
    $repository = $doctrine->getRepository(Product::class);
    $products = $repository->findBy(["category"=>$category]);
    
    return $this->render('partials/_product.html.twig',compact('products'));
    }
    #[Route('/category/{id}', name: 'category')]
    public function category(ManagerRegistry $doctrine, int $id): Response
    {
        $repository = $doctrine->getRepository(Category::class);
        $category = $repository->find($id);
      
        return $this->render('page/category.html.twig',compact('category'));
    }
}

