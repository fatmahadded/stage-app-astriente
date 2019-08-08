<?php


namespace App\Service;


use App\Entity\Intervention;
use App\Entity\Rapport;
use App\Entity\Utilisateur;
use App\Repository\AstreinteRepository;
use App\Repository\RapportRepository;
use Symfony\Component\HttpFoundation\Response;

class RapportService
{
    /**
     * @param Rapport |null $rapport
     * @return Intervention []
     */

    public function  getPdf(Rapport $rapport,RapportRepository $rapportRepository) {
        $interventions = $rapport->getInterventions();
        return $interventions ;
    }

    public function sendConfirmationMaill(\Swift_Mailer $mailer)
{
    $message = (new \Swift_Message(' Rappel Rapport'))
        ->setFrom('astreinteapp@gmail.com')
        ->setTo('hajer.harbaoui@esprit.tn')
        ->setBody('Merci de remplir le rapport ','text/plain');
    $mailer->send($message);
    return new Response('mail sent!! ', Response::HTTP_OK);
}


    public function getU(AstreinteRepository $repo)
    {
        return $result= $repo->findusers();
    }

}