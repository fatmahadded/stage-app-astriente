<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vivier", inversedBy="utilisateurs")
     */
    private $vivier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Repos")
     */
     private $repos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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

    public function getRepos(): ?Repos
    {
        return $this->repos;
    }

    public function setRepos(?Repos $repos): self
    {
        $this->repos = $repos;

        return $this;
    }
}
