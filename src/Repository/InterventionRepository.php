<?php

namespace App\Repository;

use App\Entity\Intervention;
use App\Entity\Rapport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Intervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervention[]    findAll()
 * @method Intervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterventionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Intervention::class);
    }


//    public function getInterventionsByRapport (Rapport $rapport)
//    {
//        return $this->createQueryBuilder('intervention')
//            ->innerJoin('intervention.rapport', 'rapport')
//            ->where("rapport.id = :rapportId")
//            ->setParameter('rapportId', $rapport->getId())
//            ->getQuery()
//            ->getResult();
//    }

//InterventionsByRapport !

    public function getInterventionsByRapport(Rapport $rapport){
//        if(is_null($rapport)) {
//            $query = $this->createQueryBuilder('i')
//                ->select('i')
//                ->getQuery()->getResult();
//        }else {
            $query = $this->createQueryBuilder('i')
                ->select('i')
                ->join('i.rapport', 'r')
                ->where('r.id = :rapport')
                ->setParameter('rapport', $rapport)
                ->getQuery()->getResult();
//        }
        return $query;
    }
    public function getInterventionByRapport (EntityManager $em, Rapport $rapport){


        {
            $qb = $em->createQueryBuilder($rapport);
            $qb->select('i')
                ->from('App\Entity\Intervention', 'i')
                ->where('i.rapport = :rap')
                ->setParameter('rap', $rapport);
            $query = $qb->getQuery();
            $result = $query->getResult();
            return $result;
        }

    }



    // /**
    //  * @return Intervention[] Returns an array of Intervention objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Intervention
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
