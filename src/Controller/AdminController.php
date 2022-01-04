<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(PostRepository $postRepository, CategoryRepository $categoryRepository, AuthorRepository $authorRepository): Response
    {
        $posts = $postRepository->countPostsCreated();
        $authors = $authorRepository->countAuthorsCreated();
        $categories = $categoryRepository->countCategoriesCreated();

        $totalCategories = count($categories);
        $totalPosts = count($posts);
        $totalAuthor = count($authors);

        return $this->render('admin/index.html.twig', [
            'totalPost' => $totalPosts,
            'totalAuthor' => $totalAuthor,
            'totalCategory' => $totalCategories
        ]);
    }
}
