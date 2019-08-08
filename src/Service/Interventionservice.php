<?php


namespace App\Service;


use App\Entity\JourFerie;
use App\Entity\Rapport;
use App\Repository\InterventionRepository;
use App\Repository\JourFerieRepository;
use App\Repository\RapportRepository;

class Interventionservice
{


    protected $repo;

    public function __construct(InterventionRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Rapport |null $rapport
     *  @param JourFerieRepository| null $jourFerieRepository
     * @return float|int
     */
    public  function calculRepos($rapport , $jourFerieRepository) {
        $hours=0;
        $nbrJoursOuvre=5;
        $nbrJoursferie=0;
        $nbrWeekend=0;

        if ($rapport) {
            foreach ($rapport->getInterventions() as $intervention) {
                $heureDebut=$intervention->getHeureDebut()->format('H');
                $heureFin=$intervention->getHeureFin()->format('H');

            $heureFin2=$heureFin;
            $heureDebut2=$heureDebut;
                switch($heureFin2) {
                    case 23: $heureFin2=-1 ;
                        break;
                    case 22: $heureFin2=-2 ;
                        break;
                    case 21: $heureFin2=-3 ;
                        break;
                    case 20: $heureFin2=-4 ;
                        break;
                    case 19: $heureFin2=-5 ;
                        break;

                }
                switch($heureDebut2) {
                    case 00 : $heureDebut2= 24 ;
                        break;
                    case 01 : $heureDebut2= 25 ;
                        break;
                    case 02 : $heureDebut2= 26 ;
                        break;
                    case 03 : $heureDebut2= 27 ;
                        break;
                    case 04 : $heureDebut2= 28 ;
                        break;
                    case 05 : $heureDebut2= 29 ;
                        break;
                    case 06 : $heureDebut2= 30 ;
                        break;
                        case 07 : $heureDebut2= 31 ;
                        break;
                    case 8 : $heureDebut2= 31 ;
                    break;

                }
                $jf=$jourFerieRepository->findAll();
                foreach ( $jf as $jourFerie) {
                    if($jourFerie->getJour() == $intervention->getDate()) {
                        $nbrJoursOuvre--;
                        $nbrJoursferie++;
                    }
                }
                if ($intervention->getDate()->format('w')==0 || $intervention->getDate()->format('w')==6 ) {
                    $nbrWeekend++;
                    $nbrJoursOuvre--;
                }

                    if ($heureDebut2 >= 19 && $heureFin2 < 9 ){
                        if ($heureFin<$heureDebut){

                            switch($heureFin) {
                                case 00: $heureFin=24 ;
                                    break;
                                case 01: $heureFin=25 ;
                                    break;
                                case 02: $heureFin=26 ;
                                    break;
                                case 03: $heureFin=27 ;
                                    break;
                                case 04: $heureFin=28 ;
                                    break;
                                case 05: $heureFin=29 ;
                                    break;
                                case 06: $heureFin=30 ;
                                    break;
                                case 07: $heureFin=31 ;
                                break;
                                case 8: $heureFin=32 ;
                                    break;

                            }
                        }
                        $hours += $heureFin - $heureDebut;
                        if (
                            $intervention->getHeureFin()->format('i') -
                            $intervention->getHeureDebut()->format('i') > 0 )
                            $hours=$hours+1 ;
                        elseif( ( $intervention->getHeureFin()->format('s')-
                                $intervention->getHeureDebut()->format('s') > 0) && (
                                $intervention->getHeureFin()->format('i')-
                                $intervention->getHeureDebut()->format('i')===0)
                        )
                            $hours=$hours+1 ;

                    }

        }
            $hours=$hours*1.25;
    }
        return $hours;
    }


    /**
     * @param Rapport |null $rapport
     *  @param JourFerieRepository| null $jourFerieRepository
     * @return float|int
     */
public function calculSalaireParAstreinte($rapport,$jourFerieRepository) {

    $salaire=0;
    $nbrJoursOuvre=5;
    $nbrJoursferie=0;
    $nbrWeekend=0;
    if ($rapport) {
        foreach ($rapport->getInterventions() as $intervention) {
            $jf=$jourFerieRepository->findAll();
            foreach ( $jf as $jourFerie) {
                if($jourFerie->getJour() == $intervention->getDate()) {
                    $nbrJoursOuvre--;
                    $nbrJoursferie++;
                }
            }
            if ($intervention->getDate()->format('w')==0 || $intervention->getDate()->format('w')==6 ) {
                $nbrWeekend++;
            }

        }
$salaire= $nbrJoursOuvre*15+$nbrWeekend*43.38+$nbrJoursferie*34.85;
        }

return $salaire;

}

//public function convertirEnPdf(Rapport $rapport , RapportRepository $rapportRepository){
//    if ($rapport) {
//
//        foreach ($rapport->getInterventions() as $intervention) {
//
//        }
//    }
//
//}

}