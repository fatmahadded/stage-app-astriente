<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

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
     * @Serializer\Groups({"astreinte"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="astreintes")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"astreinte"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Paye", cascade={"persist", "remove"})
     */
    private $paye;

    /**
     * @ORM\OneToOne(targetEntity="Rapport", cascade={"persist", "remove"})
     *  @Serializer\Groups({"astreinte"})
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="Semaine", inversedBy="astreintes")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"astreinte"})
     */
    private $semaine;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Groups({"astreinte"})
     */
    private $salaire;

    /**
     * @return mixed
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * @param mixed $salaire
     *
     */
    public function setSalaire($salaire): void
    {
        $this->salaire = $salaire;
    }


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vivier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vivier;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Groups({"astreinte"})
     */
    private $repos;

    /**
     * @return mixed
     */


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

    /**
     * @return mixed
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * @param mixed $repos
     */
    public function setRepos($repos): void
    {
        $this->repos = $repos;
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

    public function getVivier(): ?Vivier
    {
        return $this->vivier;
    }

    public function setVivier(?Vivier $vivier): self
    {
        $this->vivier = $vivier;

        return $this;
    }



}
