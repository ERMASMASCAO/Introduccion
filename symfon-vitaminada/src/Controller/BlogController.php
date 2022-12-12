<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

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
    

    #[Route('/blog/new', name: 'new-post')]
    public function newPost(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();   
            $post->setSlug($slugger->slug($post->getTitle()));
            $post->setPostUser($this->getUser());
            $post->setNumLikes(0);
            $post->setNumComments (0);
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->render('blog/new-post.html.twig', array(
                'form' => $form->createView()    
            ));
        }
        return $this->render('blog/new-post.html.twig', array(
            'form' => $form->createView()    
        ));
        }
        

        #[Route('/video-page/{slug}', name: 'video-page')]
        public function post(ManagerRegistry $doctrine, $slug, Request $request): Response
        {
        $repositorio = $doctrine->getRepository(Post::class);
        $video = $repositorio->findOneBy(["slug"=>$slug]);

        $comments = new Comments();
        $form = $this->createForm(CommentFormType::class, $comments);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comments = $form->getData();
            $comments->setPost($video);
            //Aumentamos el 1 el número de comentarios del post
            $video->setNumComments($video->getNumComments() + 1);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($comments);
            $entityManager->flush();
            return $this->redirectToRoute('video-page', ["slug" => $video->getSlug()]);

        
        }
        return $this->render('blog/video-page.html.twig', [
            'video' => $video,
            'commentForm' => $form->createView()
        ]);
}


}
