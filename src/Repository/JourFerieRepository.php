<?php

namespace App\Repository;

use App\Entity\JourFerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JourFerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method JourFerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method JourFerie[]    findAll()
 * @method JourFerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourFerieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JourFerie::class);
    }

    // /**
    //  * @return JourFerie[] Returns an array of JourFerie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JourFerie
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
