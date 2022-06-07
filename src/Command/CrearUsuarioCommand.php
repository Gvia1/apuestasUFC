<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CrearUsuarioCommand extends Command
{
    protected static $defaultName = 'crearUsuario';
    protected static $defaultDescription = 'Add a short description for your command';

    private $entityManager;
    private $userPasswordEncoder;
    public const USUARIO_ADMIN_REFERENCIA = 'user-admin';
    public const USUARIO_USER_REFERENCIA = 'user-user';

    public function __construct(EntityManagerInterface  $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        // $product = new Product();
        // $manager->persist($product);
            $usuario=new User;
            $usuario->setUsername('admin');
            $usuario->setRoles(['ROLE_ADMIN']);
            $usuario->setNombre('admin');
            $usuario->setApellidos('nimda');
            $usuario->setDireccion('gggggggggggggggggggggggggggiññok');
            $usuario->setLocalidad('tkgmgimgmnnj9ih9mjnhjgikji');
            $usuario->setEmail('esssssssswssssssseeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee3333');
            $usuario->setTelefono('4235466568');
            $usuario->setEntidad('`ppppppkk');
            $usuario->setOficina('1234');
            $usuario->setDc('12');
            $usuario->setNumeroCuenta('1234567890');
            $usuario->setPassword($this->userPasswordEncoder->encodePassword($usuario,'admin'));
            $this->entityManager->persist($usuario);
            $this->entityManager->flush();

            $usuario=new User;
            $usuario->setUsername('user');
            $usuario->setRoles(['ROLE_USER']);
            $usuario->setNombre('user');
            $usuario->setApellidos('nimda');
            $usuario->setDireccion('gggggggggggggggggggggggggggiññok');
            $usuario->setLocalidad('tkgmgimgmnnj9ih9mjnhjgikji');
            $usuario->setEmail('esssssssswssssssseeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee3333');
            $usuario->setTelefono('4235466568');
            $usuario->setEntidad('`ppppppkk');
            $usuario->setOficina('1234');
            $usuario->setDc('12');
            $usuario->setNumeroCuenta('1234567890');
            $usuario->setPassword($this->userPasswordEncoder->encodePassword($usuario,'user'));
            $this->entityManager->persist($usuario);
            $this->entityManager->flush();

            $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
