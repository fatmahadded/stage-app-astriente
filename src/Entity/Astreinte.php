<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AstreinteRepository")
 */
class Astreinte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="astreintes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Paye", cascade={"persist", "remove"})
     */
    private $paye;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rapport", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Semaine", inversedBy="astreintes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semaine;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPaye(): ?Paye
    {
        return $this->paye;
    }

    public function setPaye(?Paye $paye): self
    {
        $this->paye = $paye;

        return $this;
    }

    public function getRapport(): ?Rapport
    {
        return $this->rapport;
    }

    public function setRapport(Rapport $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getSemaine(): ?Semaine
    {
        return $this->semaine;
    }

    public function setSemaine(?Semaine $semaine): self
    {
        $this->semaine = $semaine;

        return $this;
    }


}
