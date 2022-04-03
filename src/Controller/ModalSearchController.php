<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalSearchController extends AbstractController
{
    /**
     * @Route("/modal/search", name="modal_search")
     */
    public function index(): Response
    {
        return $this->render('modal_search/index.html.twig', [
            'controller_name' => 'ModalSearchController',
        ]);
    }


    public function searchWordModal(PostRepository $postRepository, Request $request): Response
    {
        $keyword=$request->query->get('keyword'); //le nom du parametre d url
        $results=  $postRepository->searchWordModal($keyword); // methode inventee je passe mes mot cles en argumentss
        return $this->render("modal/ajax_cities.html.twig",[
               "word"=>$results
        ]);// renvoyer un morceaud  html avc les resultats dedans
    }
}
