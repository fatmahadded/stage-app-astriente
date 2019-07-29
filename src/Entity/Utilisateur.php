<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups({"astreinte:read","astreinte:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"astreinte:read"})
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astreinte:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astreinte:read"})
     */
    private $mail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vivier", inversedBy="utilisateurs")
     * @Groups({"astreinte:read"})
     */
    private $vivier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Repos")
     * @Groups({"astreinte:read"})
     */
     private $repos;

     /**
      * @ORM\OneToMany(targetEntity="App\Entity\Astreinte", mappedBy="user")

      */
     private $astreintes;

     /**
      * @ORM\Column(type="string", length=255)
      * @Groups({"astreinte:read"})
      */
     private $prenom;

     /**
      * @ORM\Column(type="string", length=255)
      */
     private $password;

     public function __construct()
     {
         $this->astreintes = new ArrayCollection();
     }




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
            $astreinte->setUserr($this);
        }

        return $this;
    }

    public function removeAstreinte(Astreinte $astreinte): self
    {
        if ($this->astreintes->contains($astreinte)) {
            $this->astreintes->removeElement($astreinte);
            // set the owning side to null (unless already changed)
            if ($astreinte->getUserr() === $this) {
                $astreinte->setUserr(null);
            }
        }

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
