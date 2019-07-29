<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AstreinteRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"astreinte:read"}},
 *     denormalizationContext={"groups"={"astreinte:write"}}
 * )
 * @UniqueEntity(fields={"semaine","vivier"})

 */
class Astreinte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"astreinte:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="astreintes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"astreinte:read","astreinte:write"})
     *
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Paye", cascade={"persist", "remove"})
     * @Groups({"astreinte:read"})
     */
    private $paye;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rapport", cascade={"persist", "remove"})
     * @Groups({"astreinte:read"})
     *
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Semaine", inversedBy="astreintes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"astreinte:read","astreinte:write"})
     */
    private $semaine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vivier")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"astreinte:read","astreinte:write"})

     */
    private $vivier;



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
