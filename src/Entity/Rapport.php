<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RapportRepository")
 */
class Rapport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"astreinte"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Intervention", mappedBy="rapport")
     */
    private $interventions;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Retour", cascade={"persist", "remove"})
     */

    private $retours;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Astreinte", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
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


    public function __construct()
    {
        $this->interventions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Intervention[]
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): self
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions[] = $intervention;
            $intervention->setRapport($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->interventions->contains($intervention)) {
            $this->interventions->removeElement($intervention);
            // set the owning side to null (unless already changed)
            if ($intervention->getRapport() === $this) {
                $intervention->setRapport(null);
            }
        }

        return $this;
    }

    public function getRetours(): ?Retour
    {
        return $this->retours;
    }

    public function setRetours(?Retour $retour): self
    {
        $this->retours=$retour;

        return $this;
    }
}
