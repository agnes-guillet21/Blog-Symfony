<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Post;
use App\Form\AddCommentsType;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use ArrayObject;
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
     * @Route(path="/detail/{id}", requirements={"id"="\d+"}, name="_detail",methods={"GET","POST"}, defaults={1})
     */
    public function getDetailPost(PostRepository $postRepository, EntityManagerInterface $entityManager, int $id, Post $post, Request $request, CategoryRepository $categoryRepository)
    {
        $postDetail = $postRepository->find($id);

        if (is_null($postDetail)) {
            throw $this->createNotFoundException();
        }
        if ($id < 1) {
            throw $this->createNotFoundException();
        }


        //Autres post du meme auteur
        $othersPostSimilaryAuthor = $postRepository->findAllSimilaryAuthor($postDetail->getAuthor()->getId(), $id);//respecter l ordre


        // A voir si je creer une methode  pr la creation  d'un commentaire pour un 1 post //instanciation du formulaire ds le controller
        $comment = new Comment();
        $comment->setPost($post);
        $comment->setCreatedAt(new \DateTime());
        $commentForm = $this->createForm(AddCommentsType::class, $comment);

        // on peut faire : $commentForm = $this ->createForm(AddCommentsType::class, $comment)->handleRequest($request);
        //traitement du formulaire prends les données et injecte les ds $comment, $request -> de http fondation
        $commentForm->handleRequest($request);


        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            // donner des valeurs sur les champs non renseigne ds le form
            $comment->setPost($post);   //recuperer l id du post
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('succes', 'Commentaire ajouté!');
            return $this->redirectToRoute('post_detail', ['id' => $post->getId()]);
        }


        //Category
        $categoriesMostPost = $categoryRepository->findAll();
        $arrayObjects = new ArrayObject($categoriesMostPost);
        $arrayObjects->uasort(
            function($categoryA, $categoryB)
            {
                if (count($categoryA->getRelation()) == count($categoryB->getRelation())) {
                    return 0;
                }
                return count($categoryA->getRelation()) < count($categoryB->getRelation()) ? 1 : -1;
            }
        );
        // si on ne rentre pas ds le if on redirige
        return $this->render('post/detail_post.html.twig',
            [
                "postDetail" => $postDetail,
                "commentForm" => $commentForm->createView(),
                "othersPostAuthor" => $othersPostSimilaryAuthor,
                "categories" => $arrayObjects
            ]);


    }




}
