<?php

namespace App\Controller;

use App\Repository\SemaineRepository;
use App\Service\AccueilService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
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


    /**
     * @Route("/accueil/semaines", name="accueil",methods={"GET","HEAD"})
     */
    public function getSemainesAstreintes(AccueilService $accueilService, SemaineRepository $repository)
    {

        $entityManager = $this->getDoctrine()->getManager();
        return $this->json($accueilService->getSemainesAstreintes($entityManager));
    }

    /**
     * @Route("/accueil/astreinte/{idSemaine}/{idVivier}", methods={"GET","HEAD"})
     */
    public function getAstreinteSemaine(AccueilService $accueilService,
                                        $idSemaine, $idVivier)
    {
        $results = $accueilService->getAstreinteSemaine($idSemaine, $idVivier);
        return $this->json($results);
    }
    /**
     * @Route("/accueil/all/astreinte/{idSemaine}", methods={"GET","HEAD"})
     */
    public function getAllAstreinteSemaine(AccueilService $accueilService,
                                        $idSemaine)
    {
        $results = $accueilService->getAllAstreinteSemaine($idSemaine);
        return $this->json($results);
    }

    /**
     * @Route("/accueil/astreinteXls/{dateDeb}/{dateFin}/{vivier}", name="astreinteXLS",methods={"GET","HEAD"})
     */
    public function getXLS(AccueilService $accueilService, $dateDeb, $dateFin, $vivier, KernelInterface $appKernel)
    {
        $deb = date_create($dateDeb);
        $fin = date_create($dateFin);
        $entityManager = $this->getDoctrine()->getManager();
        $results = $accueilService->getXLS($entityManager, $deb, $fin, $vivier);
        return $this->json($results);
    }

    /**
     * @Route("/accueil/add/astreinte",methods={"POST","HEAD"})
     */
    public function addAstreinte(AccueilService $accueilService, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $result = $accueilService->addAstreinte($entityManager, $data["idSemaine"], $data["idUser"], $data["idVivier"]);

        return $this->json($result);
    }
    /**
     * @Route("/accueil/send/confirmation",methods={"GET","HEAD"})
     */
    public function sendConfirmationMail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Confirmation d\'astreinte'))
            ->setFrom('astreinteapp@gmail.com')
            ->setTo('astreinteapp@gmail.com')
            ->setBody('Vous êtes maintenant inscrit à l\'astreinte de la semaine ....','text/plain');
        $mailer->send($message);
        return new Response('mail sent!! ', Response::HTTP_OK);
    }

}
