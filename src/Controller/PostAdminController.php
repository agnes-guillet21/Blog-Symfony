<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostAdminController extends AbstractController
{
    /**
     * @Route("/post/admin", name="post_admin")
     */
    public function index(): Response
    {
        return $this->render('post_admin/index.html.twig', [
            'controller_name' => 'PostAdminController',
        ]);
    }
}
