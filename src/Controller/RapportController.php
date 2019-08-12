<?php


namespace App\Controller;


use App\Entity\Astreinte;
use App\Entity\Intervention;
use App\Entity\Rapport;
use App\Entity\Retour;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api", name="api_intervention")
 */
class RapportController extends AbstractFOSRestController
{

    /**
     * @Rest\Post("/{idAstrinte}/rapport")
     * @Entity("astreinte", expr="repository.find(idAstrinte)")
     * @param EntityManagerInterface $entityManager
     * @return Rapport[]
     * @throws Exception
     */

    public function addRapportToBase(Request $request,
                                     Astreinte $astreinte,
                                     EntityManagerInterface $entityManager)
    {
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
        foreach ($data['Interventions'] as $interventionData) {
            $Intervention = new Intervention();
            $Intervention->setLabel($interventionData["label"]);
            $date = new DateTime($interventionData['date']);
            $Intervention->setDate($date);
            $Intervention->setHeureDebut(new DateTime($interventionData["heureDebut"]));
            $Intervention->setHeureFin(new DateTime($interventionData["heureFin"]));
            $rapport->addIntervention($Intervention);
            $entityManager->persist($Intervention);
        }

        $entityManager->persist($retour);

        $entityManager->persist($rapport);
        $astreinte->setRapport($rapport);

        $entityManager->flush();

        return $this->json($rapport);

    }

}
