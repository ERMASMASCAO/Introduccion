<?php

namespace App\Repository;

use App\Entity\Post;
use App\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Post $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Post $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    /**
    * @return Post[] Returns an array of Post objects
    */
    public function findByTextPaginated(int $page, string $searchTerm)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere("p.content LIKE :val")
            ->setParameter('val', '%'.$searchTerm.'%')
            ->orderBy('p.publishedAt', 'DESC');
        
        return (new Paginator($qb))->paginate($page);
    }
    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /**
    * @return Post[] Returns an array of Post objects
    */
    public function findAllPaginated(int $page): Paginator
    {
        $qb =  $this->createQueryBuilder('p')
            ->orderBy('p.publishedAt', 'DESC')            
        ;
        
        return (new Paginator($qb))->paginate($page);
    }

    /**
    * @return Post[] Returns an array of Post objects
    */
    public function findRecents()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.publishedAt', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
    
}