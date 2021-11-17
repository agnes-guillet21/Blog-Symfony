<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("post", name="post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/post", name="posts")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @Route(path="/list",name="list")
     */
    public function getListPost(EntityManagerInterface $entityManager){
        $posts = $entityManager->getRepository(Post::class)->findAll();
        var_dump($posts);
        exit();
        $category = $entityManager->getRepository(Category::class)->findAll();
        $author = $entityManager->getRepository(Author::class)->findAll();
        return $this->render('home/index.html.twig',[
            'listPosts' => $posts,
            'category' => $category,
            'author' => $author
        ]);
        var_dump($posts);
        var_dump($category);
        var_dump($author);
    }
}
