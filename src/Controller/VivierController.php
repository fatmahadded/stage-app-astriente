<?php

namespace App\Controller;

use App\Service\VivierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VivierController extends AbstractController
{
    /**
     * @Route("/vivier", name="vivier")
     */
    public function index()
    {
        return $this->render('vivier/index.html.twig', [
            'controller_name' => 'VivierController',
        ]);
    }

    /**
     * @Route("/api/addVivier",methods={"POST","HEAD"})
     */
    public function addVivier(Request $request,VivierService $service)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(),true);
        $result=$service->addVivier($data,$entityManager);
        return $this->json($result);
    }
}
