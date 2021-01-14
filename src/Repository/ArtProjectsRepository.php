<?php

namespace App\Repository;

use App\Entity\ArtProjects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtProjects|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtProjects|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtProjects[]    findAll()
 * @method ArtProjects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtProjects::class);
    }

    // /**
    //  * @return ArtProjects[] Returns an array of ArtProjects objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArtProjects
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
