<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactFormType;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;


class PageController extends AbstractController
{
    //Esta es la ruta blog
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $repository = $doctrine->getRepository(Category::class);
        
        $categories = $repository->findAll();

        $repositoryPost = $doctrine->getRepository(Post::class);
        
        $posts = $repositoryPost->findAll();
    
        return $this->render('page/index.html.twig', ['categories' => $categories,'posts' => $posts]);
    }
    
    //Esta es la ruta about
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig', []);
    }
    //Esta es la ruta contact
    #[Route('/contact', name: 'contact')]
    public function contact(ManagerRegistry $doctrine, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contacto = $form->getData();    
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($contacto);
            $entityManager->flush();
            return $this->redirectToRoute('thankyou', []);
        }
        return $this->render('page/contact.html.twig', array(
            'form' => $form->createView()    
        ));
    }
    /**
     * @Route("/thankyou", name="thankyou")
     */
    public function thankyou(): Response
    {
        return $this->render('page/thankyou.html.twig', []);
    }
    
    
    
}
