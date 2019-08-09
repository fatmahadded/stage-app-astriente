<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups({"astreinte"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"astreinte"})
     */
    private $nombreHeures;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"astreinte"})
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

    /**
     * @return mixed
     */
    public function getNombreHeures()
    {
        return $this->nombreHeures;
    }

    /**
     * @param mixed $nombreHeures
     */
    public function setNombreHeures($nombreHeures): void
    {
        $this->nombreHeures = $nombreHeures;
    }


//    public function getNombreHeures(): ?string
//    {
//        return $this->nombreHeures;
//    }
//
//    public function setNombreHeures( $nombreHeures): self
//    {
//        $this->nombreHeures = $nombreHeures;
//
//        return $this;
//    }






}
