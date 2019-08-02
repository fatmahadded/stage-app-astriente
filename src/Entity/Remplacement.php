<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\RemplacementRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"remplacement:read"}},
 *
 * )
 */
class Remplacement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"astreinte:read","astreinte:write","remplacement:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"astreinte:read","astreinte:write","remplacement:read"})
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     * @Groups({"astreinte:read","astreinte:write","remplacement:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"astreinte:read","astreinte:write","remplacement:read"})
     */
    private $seance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Astreinte", inversedBy="remplacements",)
     * @ORM\JoinColumn(nullable=false)
     */
    private $astreinte;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"astreinte:read","astreinte:write","remplacement:read"})
     */
    private $num;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSeance(): ?string
    {
        return $this->seance;
    }

    public function setSeance(string $seance): self
    {
        $this->seance = $seance;

        return $this;
    }

    public function getAstreinte(): ?Astreinte
    {
        return $this->astreinte;
    }

    public function setAstreinte(?Astreinte $astreinte): self
    {
        $this->astreinte = $astreinte;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }
}
