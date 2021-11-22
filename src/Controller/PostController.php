<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
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
     *
     * @Route(path="/detail/{id}", requirements={"id"="\d+"}, name="/detail",methods={"GET","POST"}, defaults={1})
     */
    public function getDetailPost( PostRepository $postRepository, int $id){
        $postDetail = $postRepository->find($id);

        //verifications:
        if (is_null($postDetail)){
            throw $this->createNotFoundException();
        }
        if($id<1){
            throw $this->createNotFoundException();
        }
        return $this->render('post/detail_post.html.twig',
        [
            "postDetail" => $postDetail
        ]);

    }
}
