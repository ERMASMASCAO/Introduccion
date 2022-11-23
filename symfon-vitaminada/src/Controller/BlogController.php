<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\Persistence\ManagerRegistry;


class BlogController extends AbstractController
{
    /**
     * @Route("/video-page/{slug}/like", name="post_like")
     */
    public function like(ManagerRegistry $doctrine, $slug): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $post = $repository->findOneBy(["slug" => $slug]);
        if ($post) {
            $post->setNumLikes($post->getNumLikes() + 1);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
        }
        return $this->redirectToRoute('video-page', ["slug" => $post->getSlug()]);
    }
    
}
