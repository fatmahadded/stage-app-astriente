<?php


namespace App\Controller;


use App\Entity\Retour;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api", name="api_retour")
 */
class RetourController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/retour")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addRetourToBase(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $data = $request->request->all()['formData'];//var_dump($data); die;
        //$retour = $serializer->serialize($data, 'json');
        //$from = $this->createForm(RetourType::class,$data);
       // $from->handleRequest($request);

        $retour = new Retour();
        $retour->setEntreeAppreciated($data["entreeAppreciated"]);
        $retour->setEntreeToImprove($data["entreeToImprove"]);
        $retour->setMoyensAppreciated($data["moyensAppreciated"]);
        $retour->setMoyensToImprove($data["moyensToImprove"]);
        $retour->setInterventionBonnePratique($data["interventionBonnePratique"]);
        $retour->setInterventionDifficultes($data["interventionDifficultes"]);
        $retour->setInterventionCommentaires($data["interventionCommentaires"]);


        $entityManager->persist($retour);
        $entityManager->flush();

        return new Response('Its OK');

    }
}
