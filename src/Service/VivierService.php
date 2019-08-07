<?php


namespace App\Service;

use App\Entity\Vivier;
use App\Repository\EntiteRepository;
use App\Repository\VivierRepository;
use Doctrine\ORM\EntityManager;

class VivierService
{
    private $entiteRepsitory;

    public function __construct(VivierRepository $repo, EntiteRepository $entiteRepsitory)
    {
        $this->repo = $repo;
        $this->entiteRepsitory = $entiteRepsitory;

    }

    public function addVivier($data, EntityManager $em)
    {
        $vivier = new Vivier();
        $vivier->setLabel($data["label"]);
        $vivier->setEntite($this->entiteRepsitory->find($data["entite"]));
        $em->persist($vivier);
        $em->flush();
        return $vivier;
    }
}