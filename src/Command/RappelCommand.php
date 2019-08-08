<?php


namespace App\Command;


use App\Repository\AstreinteRepository;
use App\Service\RapportService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RappelCommand extends Command
{


    public function __construct( RapportService $service, EntityManagerInterface $em, \Swift_Mailer $mailer, AstreinteRepository $repo)
    {

        $this->em=$em;
        $this->service=$service;
        $this->mailer=$mailer;
        $this->repo=$repo;
        parent::__construct();

    }

    protected function configure()
    {
        $this
            ->setName('app:rappel-rapport')

//            ->addArgument('sec', InputArgument::REQUIRED, 'seconds.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('done');
        // $output->writeln('sec: '.$inpuclqqt->getArgument('sec'));
        $users=$this->service->getU($this->repo);
        foreach($users as $u )
        {
            $this->service->sendConfirmationMaill($this->mailer);

        }

    }

}