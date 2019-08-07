<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Service\UtilisateurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        var_dump($data["mail"]);
        var_dump($data["password"]);
        $service->sendConfirmationMail($data["mail"], $data["password"]);
        return $this->json($result);
    }

<<<<<<< Updated upstream
=======
<<<<<<< Updated upstream
=======
>>>>>>> Stashed changes
    /**
     * @Route("/user/mail/{mail}",methods={"GET","HEAD"})
     */
    public function getUserMail(UtilisateurService $service, $mail)
    {

<<<<<<< Updated upstream
        $result=$service->getUserMail($mail);
=======
        $result = $service->getUserMail($mail);
>>>>>>> Stashed changes
        return $this->json($result);
    }

    /**
<<<<<<< Updated upstream
     * @Route("/user/vivier/{vivier}",methods={"GET","HEAD"})
=======
     * @Route("/api/user/vivier/{vivier}",methods={"GET","HEAD"})
>>>>>>> Stashed changes
     */
    public function getUserVivier(UtilisateurService $service, $vivier)
    {

<<<<<<< Updated upstream
        $result=$service->getUserVivier($vivier);
        return $this->json($result);
    }



=======
        $result = $service->getUserVivier($vivier);
        return $this->json($result);
    }

    /**
     * @Route("/api/role/{role}", name="role",methods={"GET","HEAD"})
     */
    public function getRoleAdmin(UtilisateurRepository $repository, $role)
    {
        return $this->json($repository->findUserByRoleUser($role));
    }
>>>>>>> Stashed changes
>>>>>>> Stashed changes

}
