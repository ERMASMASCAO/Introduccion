<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BlogController
{
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
    public function show($entryId)
    {
        return new Response(
            '<html><body>Entrada ' . $entryId . '</body></html>'
        );
    }

    /**
    * @Route("/blog/{page}", name="blog_page", requirements={"page"="\d+"})
    */

    public function listPage($page)
    {
        return new Response(
            '<html><body>Página ' . $page . '</body></html>'
        );
    }
    /**

    * @Route("/blog/{entryName}/{entryId}", name="blog_show_by_id")

    */

    public function showById($entryId)
    {
        return new Response(
            '<html><body>Entrada ' . $entryId . '</body></html>'
        );
    }
}
?>