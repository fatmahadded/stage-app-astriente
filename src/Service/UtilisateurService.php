<?php


namespace App\Service;


use App\Entity\Astreinte;
use App\Entity\Repos;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UtilisateurService
{

    public function __construct(UtilisateurRepository $repo, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repo = $repo;
        $this->passwordEncoder = $passwordEncoder;

    }

    public function addUilisateur($data, EntityManager $em)
    {

        $user = new Utilisateur();
        $user->setNom($data["nom"]);
        $user->setPrenom($data["prenom"]);
        $user->setMail($data["mail"]);
        $user->setVivier($data["vivier"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $data["password"]
                    ));
        $roles=[];
        array_push($roles,$data["roles"]);
        $user->setRoles($roles);
        $user->setIsActive('Actif');
        $repo = new Repos();
        $repo->setNombreHeures(0);
        $user->setRepos($repo);
        $em->persist($user);
        $em->flush();
        return $user;
    }

    public function getUserMail($mail)
    {
        return $this->repo->findOneBy(['mail' => $mail]);
    }

    public function getUserVivier($vivier)
    {
        return $this->repo->findBy(['vivier' => $vivier]);
    }

}