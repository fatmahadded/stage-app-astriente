<?php

namespace App\Repository;

use App\Entity\Astreinte;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Astreinte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astreinte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astreinte[]    findAll()
 * @method Astreinte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstreinteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Astreinte::class);
    }

    /**
     * get user astreintes by year
     * @param Utilisateur $utilisateur
     * @param $year
     * @return Astreinte[]
     */
    public function getAstreintesByYear(Utilisateur $utilisateur, $year)
    {
        return $this->createQueryBuilder('astreinte')
            ->innerJoin('astreinte.user', 'user')
            ->innerJoin('astreinte.semaine', 'semaine')
            ->where("user.id = :userId")
            ->andWhere('semaine.debutSemaine LIKE :year OR semaine.finSemaine LIKE :year')
            ->setParameters([
                'userId' => $utilisateur->getId(),
                'year' => '%'.$year.'%',
            ])
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Astreinte[] Returns an array of Astreinte objects
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
    public function findOneBySomeField($value): ?Astreinte
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function searchAstreinteByUser($user){
        //1 er cas : pas de utilisateur
        if(is_null($user)) {
            $query = $this->createQueryBuilder('a')
                ->select('a')
                ->getQuery()->getResult();
        }else {
            //2eme cas : y a un utilisateur
            $query = $this->createQueryBuilder('a')
                ->select('a')
                ->join('a.user', 'u')
                ->where('a.user = :utilisateur')
                ->setParameter('utilisateur', $user)
                ->getQuery()->getResult();
        }

        return $query;
    }

    public function findusers()
    {
        return $this->getEntityManager()->createQuery
        (
            "select m from App\Entity\Astreinte m WHERE m.rapport IS NULL ")
            ->getResult();
    }


}
