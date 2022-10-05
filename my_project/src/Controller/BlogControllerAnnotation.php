<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BlogControllerAnnotation extends AbstractController{
    
    /**
    * @Route("/blog", name="blog_list")
    */
    public function list()
    {
        $content = "<ul>";
        for($i = 1; $i <= 10; $i++){
          $content .= "<li>Entrada $i </li>";
        }
        $content .= "</ul>";
          return new Response(
              "<html><body>$content</body></html>"
          );
    }
    /**
    * @Route("/blog/{entryName}", name="blog_show")
    */
    public function show($entryName)
    {
        return new Response(
            '<html><body>Entrada ' . $entryName . '</body></html>'
        );
    }
}
?>