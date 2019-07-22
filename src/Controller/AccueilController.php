<?php

namespace App\Controller;

use App\Entity\Semaine;
use App\Repository\SemaineRepository;
use App\Service\AccueilService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    //cette méthode retourne les semaines que l'utilisateur peut modifier
    /**
     * @Route("/accueil/semaines", name="accueil",methods={"GET","HEAD"})
     */
    public function getSemainesAstreintes(AccueilService $accueilService, SemaineRepository $repository)
    {

        $entityManager = $this->getDoctrine()->getManager();
        return $this->json($accueilService->getSemainesAstreintes($entityManager));
    }

    /**
     * @Route("/accueil/astreinte", name="astreinte",methods={"GET","HEAD"})
     */
    public function getAstreinteSemaine(AccueilService $accueilService, SemaineRepository $repository,Request $request)
    {
        //$idSemaine=$request->query->get('id');
        $data = json_decode($request->getContent(),true);
        $entityManager = $this->getDoctrine()->getManager();
        return $this->json($accueilService->getAstreinteSemaine($entityManager,$data["idSemaine"],$data["idVivier"]));
    }
    /**
     * @Route("/accueil/astreinte/xls", name="astreinte",methods={"GET","HEAD"})
     */
    public function getXLS(AccueilService $accueilService,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(),true);
               $accueilService->getXLS($entityManager,$data["dateDeb"],$data["dateFin"]);
    }

    /**
     * @Route("/accueil/add/astreinte",methods={"POST","HEAD"})
     */
    public function addAstreinte(AccueilService $accueilService,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(),true);
        $result=$accueilService->addAstreinte($entityManager,$data["idSemaine"],$data["idUser"],$data["idVivier"]);
        return $this->json($result);
    }

}
