<?php

namespace App\Controller;

use App\Entity\Astreinte;
use App\Entity\Rapport;
use App\Entity\Repos;
use App\Entity\Utilisateur;
use App\Repository\AstreinteRepository;
use App\Repository\JourFerieRepository;
use App\Repository\RapportRepository;
use App\Repository\UtilisateurRepository;
use App\Service\HistoriqueService;
use App\Service\Interventionservice;
use App\Service\RapportService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class HistoriqueController extends AbstractController
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
            $reposCount =  $interventionService->calculRepos($astreinte->getRapport(),$jourFerieRepository);
            $totalRepos+=$reposCount;

            $repos= new Repos();
            $repos->setNombreHeures($reposCount);
            $repos->setRepoSalaire($salaire);
            $astreinte->setRepos($repos);
            $astreinte->setSalaire($salaire);

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
    /**
     * @Rest\Get("api/rapport/{id}", name="rapport_astreine", requirements={"id"="\d+"})
     * @ParamConverter("id", class="App\Entity\Rapport")
     */
    public function getPDF(RapportService $service,Rapport $rapport,RapportRepository $rapportRepository) {
        $interventions=$service->getPdf($rapport,$rapportRepository);


            $html = $this->renderView('historique/index.html.twig', array(
                'intervention'  => $interventions
            ));

            return new PdfResponse(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                'file.pdf'
            );

    }





}
