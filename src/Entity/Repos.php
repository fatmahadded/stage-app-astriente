<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ReposRepository")
 */
class Repos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Serializer\Groups({"astreinte"})
     */
    private $nombre_heures;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Groups({"astreinte"})
     */
    private $repoSalaire;

    /**
     * @return mixed
     */
    public function getRepoSalaire()
    {
        return $this->repoSalaire;
    }

    /**
     * @param mixed $repoSalaire
     */
    public function setRepoSalaire($repoSalaire): void
    {
        $this->repoSalaire = $repoSalaire;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreHeures(): ?string
    {
        return $this->nombre_heures;
    }

    public function setNombreHeures(string $nombre_heures): self
    {
        $this->nombre_heures = $nombre_heures;

        return $this;
    }
}
