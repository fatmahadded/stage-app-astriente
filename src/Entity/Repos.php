<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $nombre_heures;

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
