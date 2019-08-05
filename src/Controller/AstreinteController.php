<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AstreinteController extends AbstractController
{
    /**
     * @Route("/astreinte", name="astreinte")
     */
    public function index()
    {
        return $this->render('astreinte/index.html.twig', [
            'controller_name' => 'AstreinteController',
        ]);
    }
}
