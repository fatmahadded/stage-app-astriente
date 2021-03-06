<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}})
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"astreinte:read","astreinte:write","user:read", "astreinte"})
     */
    private $id;

    /**
     * @Groups({"astreinte:read","user:read","astreinte","user" })
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astreinte:read","remplacement:read","user:read","astreinte"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"astreinte:read","user:read", "astreinte"})
     */
    private $mail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vivier", inversedBy="utilisateurs")
     * @Groups({"astreinte:read","user:read"})
     */
    private $vivier;

    /**
     * @Groups({"astreinte:read","user:read","astreinte"})
     * @ORM\OneToOne(targetEntity="App\Entity\Repos",cascade={"persist","remove"})
     */
     private $repos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Astreinte", mappedBy="user")
     * @Groups({"user"})
     */
    private $astreintes;


     /**
      * @ORM\Column(type="string", length=255)
      * @Groups({"astreinte:read", "remplacement:read","user:read","astreinte"})
      */
     private $prenom;

    /**
     * @ORM\JoinColumn(nullable=true)
     * @ORM\Column(type="float")
     */
    private $solde;

     /**
      * @ORM\Column(type="string", length=255)
      */
     private $password;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isActive;


    public function __construct()
    {
        $this->astreintes = new ArrayCollection();
    }
    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function eraseCredentials()
    {

    }

    public function getUsername()
    {
        return $this->mail;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setRoles(array $roles): self
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

    /**
     * @return mixed
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param mixed $solde
     */
    public function setSolde($solde): void
    {
        $this->solde = $solde;
    }
}
