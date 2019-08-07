<?php


namespace App\Service;


use App\Entity\Astreinte;
use App\Entity\Repos;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Repository\VivierRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UtilisateurService
{

<<<<<<< Updated upstream
    public function __construct(UtilisateurRepository $repo, UserPasswordEncoderInterface $passwordEncoder, VivierRepository $vivierRepository)
    {
        $this->repo = $repo;
        $this->passwordEncoder = $passwordEncoder;
        $this->vivierRepository=$vivierRepository;
=======
    private $vivierRepsitory;

    public function __construct(UtilisateurRepository $repo,
                                UserPasswordEncoderInterface $passwordEncoder,
                                VivierRepository $vivierRepository,
                                \Swift_Mailer $mailer)
    {
        $this->repo = $repo;
        $this->passwordEncoder = $passwordEncoder;
        $this->vivierRepsitory = $vivierRepository;
        $this->mailer = $mailer;
>>>>>>> Stashed changes

    }

    public function sendConfirmationMail($email, $pass)
    {
        $message = (new \Swift_Message('Confirmation de compte'))
            ->setFrom('astreinteapp@gmail.com')
            ->setTo('hajer.harbaoui@esprit.tn')
            ->setBody('Bienvenue parmis nous. Votre USERNAME est : ' . $email .
                ' et votre PASSWORD est : ' . $pass . ' .Bon travail.', 'text/plain');
        $this->mailer->send($message);
        return null;
    }

    public function addUilisateur($data, EntityManager $em)
    {
        $user = new Utilisateur();
        $user->setNom($data["nom"]);
        $user->setPrenom($data["prenom"]);
        $user->setMail($data["mail"]);
<<<<<<< Updated upstream
        $user->setVivier($this->vivierRepository->find($data["vivier"]));
=======
<<<<<<< Updated upstream
=======
        $user->setVivier($this->vivierRepsitory->find($data["vivier"]));
>>>>>>> Stashed changes
>>>>>>> Stashed changes
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $data["password"]
        ));
        $roles = [];
        array_push($roles, $data["roles"]);
        $user->setRoles($roles);
        $user->setIsActive('Actif');
        $repo = new Repos();
        $repo->setNombreHeures(0);
        $user->setRepos($repo);
        $em->persist($user);
        $em->flush();
        var_dump($user->getMail());
        var_dump($data["password"]);
        //$this->sendConfirmationMail($user->getMail(), $data["password"]);
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