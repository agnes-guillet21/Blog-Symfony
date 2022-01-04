<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getAll()
    {
        $req= $this->createQueryBuilder('category');
        $req->where('author.id > 0');
        return $req->getQuery()->getResult();
    }

    /*
     * For admin pages
     * Count number of categories created
     */
    public function countCategoriesCreated()
    {
        return $this->createQueryBuilder('c')
        ->select('c.id')
        ->getQuery()
        ->getResult();
    }
}
