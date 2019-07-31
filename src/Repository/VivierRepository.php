<?php

namespace App\Repository;

use App\Entity\Vivier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vivier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vivier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vivier[]    findAll()
 * @method Vivier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VivierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vivier::class);
    }

    // /**
    //  * @return Vivier[] Returns an array of Vivier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vivier
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
