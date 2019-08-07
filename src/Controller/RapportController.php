<?php


namespace App\Controller;


use App\Entity\Intervention;
use App\Entity\Rapport;
use App\Entity\Retour;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api", name="api_intervention")
 */
class RapportController extends AbstractFOSRestController
{

    /**
     * @Rest\Post("/rapport")
     * @param EntityManagerInterface $entityManager
     * @return Rapport[]
     */
    public function addRapportToBase(Request $request,EntityManagerInterface $entityManager){
        $data = $request->request->all()['rapportData'];
        $retour = new Retour();
        $retour->setEntreeAppreciated($data["entreeAppreciated"]);
        $retour->setEntreeToImprove($data["entreeToImprove"]);
        $retour->setMoyensAppreciated($data["moyensAppreciated"]);
        $retour->setMoyensToImprove($data["moyensToImprove"]);
        $retour->setInterventionBonnePratique($data["interventionBonnePratique"]);
        $retour->setInterventionDifficultes($data["interventionDifficultes"]);
        $retour->setInterventionCommentaires($data["interventionCommentaires"]);

        $rapport = new Rapport();
        $rapport->setNote($data['note']);

        $rapport->setRetours($retour);
        foreach ($data['Interventions'] as $interventionData){
            $Intervention = new Intervention();
            $Intervention->setLabel($interventionData["label"]);
            try {
                $date = new \DateTime($interventionData['date']);

                $Intervention->setDate($date);
            } catch (\Exception $e) {
            }
            $Intervention->setHeureDebut($interventionData["heureDebut"]);
            $Intervention->setHeureFin($interventionData["heureFin"]);
            $rapport->addIntervention($Intervention);
            $entityManager->persist($Intervention);
        }

        $entityManager->persist($retour);

        $entityManager->persist($rapport);

        $entityManager->flush();

    }

}
