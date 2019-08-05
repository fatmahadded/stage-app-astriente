<?php


namespace App\Service;


use App\Entity\Utilisateur;
use App\Repository\AstreinteRepository;
use App\Repository\InterventionRepository;
use Doctrine\ORM\EntityManager;

class HistoriqueService
{
    protected $repo ;
    public $interventionRepository;

    public function __construct(AstreinteRepository $repo,InterventionRepository $interventionRepository)
    {
        $this->repo = $repo;
        $this->interventionRepository=$interventionRepository;
    }
    public function  ShowAstreinte(Utilisateur $user=null) {

        return $this->repo->searchAstreinteByUser($user) ;

    }

//    public function calculRepos()
//    {
////
////      //lawej 3al astreinte mte3ek -->  $id rapport
//
//
////        $result=$this->interventionRepository->findBy( ['rapport' => '$id]);
//       }
    }


////    public function getAstreinteUser(EntityManager $em,$idUser=1)
////    {
////        $qb = $em->createQueryBuilder();
////        $qb->select('a')
////            ->from('App\Entity\Astreinte', 'a')
////            ->where('a.user = :utilisateur')
////            ->setParameter('utilisateur',$idUser);
////        $query = $qb->getQuery();
////        $result = $query->getResult();
////        return $result;
////    }
//}