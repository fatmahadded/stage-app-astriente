<?php

namespace App\Controller;

use App\Entity\Astreinte;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Service\HistoriqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class HistoriqueController extends AbstractController
{
    /**
     * @Route("/historique", name="historique")
     */
    public function index()
    {
        return $this->render('historique/index.html.twig', [
            'controller_name' => 'HistoriqueController',
        ]);
    }
    /**
     * @Route("/astreinte", name="AstreinteByUser")
     */
    public function ShowAstreinteByUser( HistoriqueService $service)
    {
        $res=$service->ShowAstreinte();

        return $this->render('historique/index.html.twig', ['astreintes'=>$res]);

    }





//
//    /**
//     * @Route("/historique2/astreinte", name="astreinte",methods={"GET","HEAD"})
//     */
//    public function getAstreinteSemaine(HistoriqueService $Service,UtilisateurRepository $repository,Request $request)
//    {
//
//        $data = json_decode($request->getContent(),true);
//        $entityManager = $this->getDoctrine()->getManager();
//        return $this->json($Service->getAstreinteUser($entityManager,$data["user"]));
//    }

}
