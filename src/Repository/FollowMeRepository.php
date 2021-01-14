<?php

namespace App\Repository;

use App\Entity\FollowMe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FollowMe|null find($id, $lockMode = null, $lockVersion = null)
 * @method FollowMe|null findOneBy(array $criteria, array $orderBy = null)
 * @method FollowMe[]    findAll()
 * @method FollowMe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowMeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FollowMe::class);
    }

    // /**
    //  * @return FollowMe[] Returns an array of FollowMe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FollowMe
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
