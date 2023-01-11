<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\product;
use App\Services\ProductsService;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(ProductsService $ProductsService): Response
    {
    $products = $ProductsService->getProducts();
    return $this->render('product/product.html.twig', compact('products'));
    }


}
