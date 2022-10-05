<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class AppController extends AbstractController
{
    public function list()
    {
      return $this->render('blog/list.html.twig');
    }
    public function show($entryId)
    {
      return $this->render('blog/entry.html.twig', array('entryId' => $entryId));
    }

}
class ProductApiController extends AbstractController{
    /**
    * @Route("/api/productos/{id}", methods={"GET","HEAD"})
    */
    public function show($id)
    {
        // ... devolver una respuesta json con el producto
    }
    /**
    * @Route("/api/productos/{id}", methods={"PUT", "POST"})
    */
    public function edit($id)
    {
        // ... editar un producto
    }
}
?>