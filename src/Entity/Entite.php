<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EntiteRepository")
 */
class Entite
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vivier", mappedBy="entite")
     */
    private $viviers;

    public function __construct()
    {
        $this->viviers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Vivier[]
     */
    public function getViviers(): Collection
    {
        return $this->viviers;
    }

    public function addVivier(Vivier $vivier): self
    {
        if (!$this->viviers->contains($vivier)) {
            $this->viviers[] = $vivier;
            $vivier->setEntite($this);
        }

        return $this;
    }

    public function removeVivier(Vivier $vivier): self
    {
        if ($this->viviers->contains($vivier)) {
            $this->viviers->removeElement($vivier);
            // set the owning side to null (unless already changed)
            if ($vivier->getEntite() === $this) {
                $vivier->setEntite(null);
            }
        }

        return $this;
    }
}
