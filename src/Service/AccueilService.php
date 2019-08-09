<?php


namespace App\Service;


use App\Entity\Astreinte;
use App\Repository\AstreinteRepository;
use App\Repository\SemaineRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VivierRepository;
use Doctrine\ORM\EntityManager;


class AccueilService
{
    public function __construct(AstreinteRepository $astreinteRepository, VivierRepository $vivierRepository,
                                UtilisateurRepository $userRepository, SemaineRepository $semaineRepository,
                                \Swift_Mailer $mailer)
    {
        $this->astreinteRepository = $astreinteRepository;
        $this->semaineRepository = $semaineRepository;
        $this->userRepository = $userRepository;
        $this->vivierRepository = $vivierRepository;
        $this->mailer = $mailer;
    }

    private $astreinteRepository;
    private $semaineRepository;
    private $vivierRepository;
    private $userRepository;
    private $mailer;


    public function getSemainesAstreintes(EntityManager $em)
    {

        $date = date_create();
        date_sub($date, date_interval_create_from_date_string("7 days"));
        $date = date_format($date, "Y-m-d");
        $qb = $em->createQueryBuilder();
        $qb->select('s')
            ->from('App\Entity\Semaine', 's')
            ->where('s.finSemaine > ?1')
            ->setParameter(1, $date);
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function getAstreinteSemaine($idSemaine, $idVivier)
    {
        $result = $this->astreinteRepository->findBy(
            ['semaine' => $idSemaine,
                'vivier' => $idVivier]
        );
        return $result;
    }

    public function getAllAstreinteSemaine($idSemaine)
    {
        $result = $this->astreinteRepository->findBy(
            ['semaine' => $idSemaine]
        );
        return $result;

    }

    public function addAstreinte(EntityManager $em, $idSemaine, $idUser, $idVivier)
    {
        $astreinte = new Astreinte();
        $astreinte->setSemaine($this->semaineRepository->find($idSemaine));
        $astreinte->setUser($this->userRepository->find($idUser));
        $astreinte->setVivier($this->vivierRepository->find($idVivier));
        $em->persist($astreinte);
        $em->flush();
        return $astreinte;
    }

    public function getXLS(EntityManager $em, $dateDeb, $dateFin, $idVivier)
    {


        $qb = $em->createQueryBuilder();
        $qb->select('a')
            ->from('App\Entity\Astreinte', 'a')
            ->leftJoin('a.semaine', 's')
            ->where('s.debutSemaine >= ?1 AND s.finSemaine <= ?2')
            //->where('s.debutSemaine = 2019-01-18')
            ->andWhere('a.vivier= ?3')
            ->setParameters(array(1 => $dateDeb, 2 => $dateFin, 3 => $idVivier));
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }


}