<?php

namespace App\Command;

use App\Entity\User;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'create:admin';
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $question = new Question('Email : ', false);
        $email = $helper->ask($input, $output, $question);

        $question = new Question('Password : ', false);
        $pwd = $helper->ask($input, $output, $question);

        $date = new DateTime();

        if (!$this->em->getRepository(User::class)->findOneBy(['email' => $email])) {
            $user = new User();
            $this->em->persist($user);

            $user
                ->setUuid(Uuid::uuid4())
                ->setEmail($email)
                ->setPassword(password_hash($pwd, PASSWORD_BCRYPT))
                ->setRoles(['ROLE_ADMIN'])
                ->setDateCreation($date)
                ->setFirstName('Admin')
                ->setLastName('istrateur')
                ->setBirthDate($date->sub(new DateInterval('P30Y')));

            $this->em->flush();

            $output->writeln('User successfully generated!');
        }

        return 0;
    }
}
