<?php

namespace App\Repository;

use App\Entity\DigitalProjects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DigitalProjects|null find($id, $lockMode = null, $lockVersion = null)
 * @method DigitalProjects|null findOneBy(array $criteria, array $orderBy = null)
 * @method DigitalProjects[]    findAll()
 * @method DigitalProjects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DigitalProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DigitalProjects::class);
    }

    // /**
    //  * @return DigitalProjects[] Returns an array of DigitalProjects objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DigitalProjects
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
