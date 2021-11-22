<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route(path="", name="home")
     */
    public function getListPost(EntityManagerInterface $entityManager)
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();

        return $this->render('home/index.html.twig', [
            'listPosts' => $posts, // cle 'listPost' / valeur :la variable

        ]);
    }

}
