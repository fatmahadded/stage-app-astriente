<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Entity\Rapport;
use App\Repository\InterventionRepository;
use App\Service\Interventionservice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InterventionController extends AbstractController
{
    /**
     * @Route("/intervention", name="intervention")
     */
    public function index()
    {
        return $this->render('intervention/index.html.twig', [
            'controller_name' => 'InterventionController',
        ]);
    }

}
