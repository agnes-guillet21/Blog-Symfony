<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Comment;

use App\Entity\Post;
use App\Form\AddCommentsType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function getDetailPost( PostRepository $postRepository,EntityManagerInterface $entityManager ,int $id,Post $post, Request $request, Category $category){
        $postDetail = $postRepository->find($id);

        //verifications:
        if (is_null($postDetail)){
            throw $this->createNotFoundException();
        }
        if($id<1){
            throw $this->createNotFoundException();
        }

        // A voir si je creer une methode  pr la creation  d'un commentaire pour un 1 post
        //instanciation du formulaire ds le controller
        $comment = new Comment();
        $comment->setPost($post);
        $comment->setCreatedAt(new \DateTime());
        $commentForm = $this ->createForm(AddCommentsType::class, $comment);

        // on peut faire : $commentForm = $this ->createForm(AddCommentsType::class, $comment)->handleRequest($request);
        //traitement du formulaire
        // prends les données et injecte les ds $comment, $request -> de http fondation

        $commentForm->handleRequest($request);


        if ($commentForm->isSubmitted() && $commentForm->isValid()){
            // donner des valeurs sur les champs non renseigne ds le form

            //recuperer l id du post
            $comment->setPost($post);

            $entityManager->persist($comment);
            $entityManager->flush();
            dump($comment);
            $this->addFlash('succes','Commentaire ajouté!');
            return $this->redirectToRoute('post/detail', ['id'=>$post->getId()]);
        }

            // si on ne rentre pas ds le if on redirige
        return $this->render('post/detail_post.html.twig',
            [
                "postDetail" => $postDetail,
                "commentForm" => $commentForm->createView()
            ]);





    }
}
