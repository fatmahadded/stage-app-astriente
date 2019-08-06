<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\AstreinteRepository;
use App\Repository\JourFerieRepository;
use App\Repository\RapportRepository;
use App\Service\Interventionservice;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Rest\Get("api/user/{id}/astreinte", name="user_astreinte_list", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"astreinte"})
     * @ParamConverter("id", class="App\Entity\Utilisateur")
     * @param Utilisateur $user
     * @param AstreinteRepository $astreinteRepository
     * @param Request $request
     * @return mixed
     */
    public function getUserAstreintes(
        Utilisateur $user,
        AstreinteRepository $astreinteRepository,
        RapportRepository $rapportRepository,
        Interventionservice $interventionService,
        EntityManagerInterface $entityManager,
        JourFerieRepository $jourFerieRepository,
        Request $request
    )
    {
//        $user = $id;
        $year = '2019';
        if ($request->query->has('year')) {
            $year = $request->query->get('year');;
        }
        $totalSalaire=0;
        $totalRepos=0;
        $astreintes = $astreinteRepository->getAstreintesByYear($user, $year);

        foreach ($astreintes as $astreinte) {
            $salaire=$interventionService->calculSalaireParAstreinte($astreinte->getRapport(),$jourFerieRepository);
            $repos=$interventionService->calculRepos($astreinte->getRapport(),$jourFerieRepository);
            $astreinte->setSalaire($salaire);
            $astreinte->setRepos($repos);
            $totalRepos+=$astreinte->getRepos();
            $totalSalaire+=$astreinte->getSalaire();
//          $astreinte->setRepos($interventionService->calculRepos2($astreinte->getRapport(),$jourFerieRepository));
        }

        $user->getRepos()->setNombreHeures($totalRepos);
        $user->setSolde($totalSalaire);
        $user->getRepos()->setRepoSalaire($totalSalaire);
        $entityManager->flush();
        return $astreintes;
//        return $user->getAstreintes();

    }


}
