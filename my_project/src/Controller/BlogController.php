<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
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
}
?>