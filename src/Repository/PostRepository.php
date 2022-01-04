<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }


    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */

    public function findAllSimilaryAuthor($idAuthor, $idPost)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.author = :author')
            ->setParameter('author', $idAuthor) //parametre passé en argument
            ->andWhere('p.id!= :idPost')
            ->setParameter('idPost' , $idPost)
            ->getQuery()//execution
            ->getResult()//donne le resultat
        ;
    }
    /*
 * For admin pages
 * Count number of post created
 */
    public function countPostsCreated()
    {
        return $this->createQueryBuilder('p')
            ->select('p.id')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
