<?php


namespace App\Service;


use App\Entity\Astreinte;
use App\Entity\Vivier;
use App\Repository\AstreinteRepository;
use App\Repository\SemaineRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VivierRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\Date;

class AccueilService
{
    public function __construct(AstreinteRepository $astreinteRepository,VivierRepository $vivierRepository,
                                UtilisateurRepository $userRepository,SemaineRepository $semaineRepository)
    {
        $this->astreinteRepository=$astreinteRepository;
        $this->semaineRepository=$semaineRepository;
        $this->userRepository=$userRepository;
        $this->vivierRepository=$vivierRepository;
    }

    private $astreinteRepository;
    private $semaineRepository;
    private $vivierRepository;
    private $userRepository;


    public function getSemainesAstreintes(EntityManager $em)
    {

        $date=date_create("2019-01-20");
        date_sub($date,date_interval_create_from_date_string("7 days"));
        $date=date_format($date,"Y-m-d");
        $qb = $em->createQueryBuilder();
        $qb->select('s')
            ->from('App\Entity\Semaine', 's')
            ->where('s.finSemaine > ?1')
            ->setParameter(1, $date)
        ;
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function getAstreinteSemaine(EntityManager $em,$idSemaine,$idVivier)
    {
        $qb = $em->createQueryBuilder();
        $qb->select('a')
            ->from('App\Entity\Astreinte', 'a')
            ->where('a.semaine = ?1')
            ->andWhere('a.vivier= ?2')
            ->setParameters(array(1 => $idSemaine, 2 => $idVivier));
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }
    public function addAstreinte(EntityManager $em,$idSemaine,$idUser,$idVivier)
    {
        $astreinte=new Astreinte();
        $astreinte->setSemaine($this->semaineRepository->find($idSemaine));
        $astreinte->setUser($this->userRepository->find($idUser));
        $astreinte->setVivier($this->vivierRepository->find($idVivier));
        $em->persist($astreinte);
        $em->flush();
        return $astreinte;
    }
    public function getXLS(EntityManager $em,$dateDeb,$dateFin)
    {
        /*$nbDeb=$this->getSemaineNumber($dateDeb);
        $nbFin=$this->getSemaineNumber($dateFin);

        $qb = $em->createQueryBuilder();
        $qb->select('a')
            ->from('App\Entity\Astreinte', 'a')
            ->where('a.semaine = ?1')
            ->andWhere('a.vivier= ?2')
            ->setParameters(array(1 => $idSemaine, 2 => $idVivier));
        $query = $qb->getQuery();
        $result = $query->getResult();*/
    }

}