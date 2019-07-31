<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Service\UtilisateurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/addUser",methods={"POST","HEAD"})
     */
    public function addUser(Request $request,UtilisateurService $service)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(),true);
        $result=$service->addUilisateur($data,$entityManager);
        return $this->json($result);
    }


}
