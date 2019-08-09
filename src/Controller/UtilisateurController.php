<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Service\UtilisateurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/api/addUser",methods={"POST","HEAD"})
     */
    public function addUser(Request $request, UtilisateurService $service)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $result = $service->addUilisateur($data, $entityManager);
        $service->sendConfirmationMail($data["mail"], $data["password"]);
        return $this->json($result);
    }


    /**
     * @Route("/user/mail/{mail}",methods={"GET","HEAD"})
     */
    public function getUserMail(UtilisateurService $service, $mail)
    {

        $result=$service->getUserMail($mail);
        return $this->json($result);
    }

    /**
     * @Route("/api/user/vivier/{vivier}",methods={"GET","HEAD"})
     */
    public function getUserVivier(UtilisateurService $service, $vivier)
    {

        $result=$service->getUserVivier($vivier);
        return $this->json($result);
    }

    /**
     * @Route("/api/role/{role}", name="role",methods={"GET","HEAD"})
     */
    public function getRoleAdmin(UtilisateurRepository $repository, $role)
    {
        return $this->json($repository->findUserByRoleUser($role));
    }


}
