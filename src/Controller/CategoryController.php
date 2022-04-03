<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function getAllCategories(CategoryRepository $categoryRepository): Response
    {
        $allCategories = $categoryRepository->findAll();
        if (is_null($allCategories)) {
            throw $this->createNotFoundException();
        }

        return $this->render('category/index.html.twig.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    public function getCategoriesHaveMostPost(CategoryRepository $categoryRepository)
    {
        $categoriesMostPost = $categoryRepository->getCategoriesWithMostPost();
        if (is_null($categoriesMostPost)) {
            throw $this->createNotFoundException();
        }
        return $this->render('post/detail_post.html.twig',
            [
                "categories" =>  $categoriesMostPost
            ]);

    }


}
