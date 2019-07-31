<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RetourRepository")
 */
class Retour
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entreeAppreciated;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entreeToImprove;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyensAppreciated;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyensToImprove;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interventionBonnePratique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interventionDifficultes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interventionCommentaires;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreeAppreciated(): ?string
    {
        return $this->entreeAppreciated;
    }

    public function setEntreeAppreciated(string $entreeAppreciated): self
    {
        $this->entreeAppreciated = $entreeAppreciated;

        return $this;
    }

    public function getEntreeToImprove(): ?string
    {
        return $this->entreeToImprove;
    }

    public function setEntreeToImprove(string $entreeToImprove): self
    {
        $this->entreeToImprove = $entreeToImprove;

        return $this;
    }

    public function getMoyensAppreciated(): ?string
    {
        return $this->moyensAppreciated;
    }

    public function setMoyensAppreciated(string $moyensAppreciated): self
    {
        $this->moyensAppreciated = $moyensAppreciated;

        return $this;
    }

    public function getMoyensToImprove(): ?string
    {
        return $this->moyensToImprove;
    }

    public function setMoyensToImprove(string $moyensToImprove): self
    {
        $this->moyensToImprove = $moyensToImprove;

        return $this;
    }

    public function getInterventionBonnePratique(): ?string
    {
        return $this->interventionBonnePratique;
    }

    public function setInterventionBonnePratique(string $interventionBonnePratique): self
    {
        $this->interventionBonnePratique = $interventionBonnePratique;

        return $this;
    }

    public function getInterventionDifficultes(): ?string
    {
        return $this->interventionDifficultes;
    }

    public function setInterventionDifficultes(string $interventionDifficultes): self
    {
        $this->interventionDifficultes = $interventionDifficultes;

        return $this;
    }

    public function getInterventionCommentaires(): ?string
    {
        return $this->interventionCommentaires;
    }

    public function setInterventionCommentaires(string $interventionCommentaires): self
    {
        $this->interventionCommentaires = $interventionCommentaires;

        return $this;
    }
}
