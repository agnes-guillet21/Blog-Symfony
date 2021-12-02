<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route(path="", name="home")
     */
    public function getListPost(EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();

        //recuperation de toutes les categories


        return $this->render('home/index.html.twig', [
            'listPosts' => $posts, // cle 'listPost' / valeur :la variable

        ]);
    }

}
