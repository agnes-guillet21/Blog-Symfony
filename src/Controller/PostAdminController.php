<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\AdminAddPostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin/post", name="post_admin")
 */
class PostAdminController extends AbstractController
{
    /**
     * @Route("/list", name="_management")
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('post_admin/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="_add")
     */
    public function createPost(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newPost = new Post();
         $formPost = $this->createForm(AdminAddPostType::class, $newPost);
         $formPost->handleRequest($request);

         if($formPost->isSubmitted() && $formPost->isValid()){
             $entityManager->persist($newPost);
             $entityManager->flush();

             $this->addFlash('success', 'Post ajouté !');

             return $this->redirectToRoute('post_admin_management'); // rester sur la meme
         }
        return $this->render('post_admin/addPost.html.twig', [

        ]);
    }

}
