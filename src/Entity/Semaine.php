<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SemaineRepository")
 */
class Semaine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"astreinte:read"})
     * @Serializer\Groups({"astreinte"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"astreinte:read"})
     * @Serializer\Groups({"astreinte"})
     */
    private $numSemaine;

    /**
     * @ORM\Column(type="date")
     * @Groups({"astreinte:read"})
     * @Serializer\Groups({"astreinte"})
     */
    private $debutSemaine;

    /**
     * @ORM\Column(type="date")
     * @Groups({"astreinte:read"})
     * @Serializer\Groups({"astreinte"})
     */
    private $finSemaine;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Astreinte", mappedBy="semaine")
     */
    private $astreintes;



    public function __construct()
    {
        $this->astreintes = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSemaine(): ?int
    {
        return $this->numSemaine;
    }

    public function setNumSemaine(int $numSemaine): self
    {
        $this->numSemaine = $numSemaine;

        return $this;
    }

    public function getDebutSemaine(): ?\DateTimeInterface
    {
        return $this->debutSemaine;
    }

    public function setDebutSemaine(\DateTimeInterface $debutSemaine): self
    {
        $this->debutSemaine = $debutSemaine;

        return $this;
    }

    public function getFinSemaine(): ?\DateTimeInterface
    {
        return $this->finSemaine;
    }

    public function setFinSemaine(\DateTimeInterface $finSemaine): self
    {
        $this->finSemaine = $finSemaine;

        return $this;
    }

    /**
     * @return Collection|Astreinte[]
     */
    public function getAstreintes(): Collection
    {
        return $this->astreintes;
    }

    public function addAstreinte(Astreinte $astreinte): self
    {
        if (!$this->astreintes->contains($astreinte)) {
            $this->astreintes[] = $astreinte;
            $astreinte->setSemaine($this);
        }

        return $this;
    }

    public function removeAstreinte(Astreinte $astreinte): self
    {
        if ($this->astreintes->contains($astreinte)) {
            $this->astreintes->removeElement($astreinte);
            // set the owning side to null (unless already changed)
            if ($astreinte->getSemaine() === $this) {
                $astreinte->setSemaine(null);
            }
        }

        return $this;
    }


}
