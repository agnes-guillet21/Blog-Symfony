<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;
use App\Repository\AuthorRepository;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route(path="", name="home")
     */
    public function getListPost(EntityManagerInterface $entityManager,PostRepository $postRepository,CategoryRepository $categoryRepository, AuthorRepository $authorRepository)
    {
        //recuperation via les methodes des repository
        $posts = $postRepository->findAll();
        $category = $categoryRepository->findAll();
        $author = $authorRepository->findAll();

        return $this->render('home/index.html.twig', [
            'listPosts' => $posts, // cle 'listPost' / valeur :la variable
            'listCategories' => $category,
            'listAuthors' => $author

        ]);
    }

}
