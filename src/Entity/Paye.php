<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PayeRepository")
 */
class Paye
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Astreinte", cascade={"persist", "remove"})
     */
    private $astreinte;

    /**
     * @return mixed
     */
    public function getAstreinte()
    {
        return $this->astreinte;
    }

    /**
     * @param mixed $astreinte
     */
    public function setAstreinte($astreinte)
    {
        $this->astreinte = $astreinte;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
