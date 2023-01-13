<?php

namespace App\Controller;

use App\Entity\Product;
use App\Services\CartService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path:'/cart')]
class CartController extends AbstractController
{
    private $doctrine;
    private $repository;
    private $cart;
    //Le inyectamos CartServices como una dependencia
    public  function __construct(ManagerRegistry $doctrine, CartService $cart)
    {
        $this->doctrine = $doctrine;
        $this->repository = $doctrine->getRepository(Product::class);
        $this->cart = $cart;
    }

    #[Route('/add/{id}', name: 'cart_add', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function cart_add(int $id): Response
    {
        $product = $this->repository->find($id);
        if (!$product)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);

        $this->cart->add($id, 1);
	    
        $data = [
            "id"=> $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "photo" => $product->getPhoto(),
            "quantity" => $this->cart->getCart()[$product->getId()]
        ];
        return new JsonResponse($data, Response::HTTP_OK);

    }
    #[Route('/', name: 'app_cart')]
    public function index(): Response
    {
    $products = $this->repository->getFromCart($this->cart);
    //hay que añadir la cantidad de cada producto
    $items = [];
    $totalCart = 0;
    foreach($products as $product){
        $item = [
            "id"=> $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "photo" => $product->getPhoto(),
            "quantity" => $this->cart->getCart()[$product->getId()]
        ];
        $totalCart += $item["quantity"] * $item["price"];
        $items[] = $item;  
    }

    return $this->render('page/cart.html.twig', ['items' => $items, 'totalCart' => $totalCart]);
    }

    #[Route('/update/{id}/{quantity}', name: 'cart_update', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function cart_update(int $id, int $quantity = 1): Response
    {
        $product = $this->repository->find($id);
        if (!$product)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);
        
        $this->cart->update($id, $quantity);
        
        $data = [
            "id"=> $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "photo" => $product->getPhoto(),
            "quantity" => $this->cart->getCart()[$product->getId()],
            "totalItems" => $this->cart->totalItems()
            ];
        return new JsonResponse($data, Response::HTTP_OK);
        
    }
   
    #[Route('/delete/{id}', name: 'cart_delete')]
    public function cart_delete(int $id): Response
    {
        $this->cart->delete($id);
        $products = $this->repository->getFromCart($this->cart);
        $totalCart = 0;
        foreach($products as $product){
            $totalCart += $this->cart->getCart()[$product->getId()] * $product->getPrice();
        }
        $data = ['total'=> $totalCart, 'totalItems' => $this->cart->totalItems()];
        return new JsonResponse($data, Response::HTTP_OK);
    }   

    
}

?>
