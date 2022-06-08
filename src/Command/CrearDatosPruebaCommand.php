<?php

namespace App\Command;

use App\Entity\Combate;
use App\Entity\CombatePeleador;
use App\Entity\Division;
use App\Entity\Evento;
use App\Entity\Metodo;
use App\Entity\MetodoEspecifico;
use App\Entity\Peleador;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class CrearDatosPruebaCommand extends Command
{
    protected static $defaultName = 'crearDatosPrueba';
    protected static $defaultDescription = 'Add a short description for your command';
    private $em;

    public function __construct(EntityManagerInterface  $em)
    {
        $this->em = $em;
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

            $metodo=new Metodo;
            $metodo->setDescripcion('TKO');

            $metodosEspecifico=new MetodoEspecifico;
            $metodosEspecifico->setDescripcion('Puñetazos');
            $metodosEspecifico->setMetodo($metodo);

            $metodosEspecifico2=new MetodoEspecifico;
            $metodosEspecifico2->setDescripcion('Patadas');
            $metodosEspecifico2->setMetodo($metodo);

            $metodo2=new Metodo;
            $metodo2->setDescripcion('KO');

            $metodosEspecifico3=new MetodoEspecifico;
            $metodosEspecifico3->setDescripcion('Gancho');
            $metodosEspecifico3->setMetodo($metodo2);

            $metodosEspecifico4=new MetodoEspecifico;
            $metodosEspecifico4->setDescripcion('Patada Circular');
            $metodosEspecifico4->setMetodo($metodo2);

            $metodo3=new Metodo;
            $metodo3->setDescripcion('Decision');

            $metodosEspecifico5=new MetodoEspecifico;
            $metodosEspecifico5->setDescripcion('Unanime');
            $metodosEspecifico5->setMetodo($metodo3);

            $metodosEspecifico6=new MetodoEspecifico;
            $metodosEspecifico6->setDescripcion('Divida');
            $metodosEspecifico6->setMetodo($metodo3);

            $metodo4=new Metodo;
            $metodo4->setDescripcion('Sumisión');

            $metodosEspecifico7=new MetodoEspecifico;
            $metodosEspecifico7->setDescripcion('Guillotina');
            $metodosEspecifico7->setMetodo($metodo4);

            $metodosEspecifico8=new MetodoEspecifico;
            $metodosEspecifico8->setDescripcion('Mataleon');
            $metodosEspecifico8->setMetodo($metodo4);

            $this->em->persist($metodo);
            $this->em->persist($metodo2);
            $this->em->persist($metodo3);
            $this->em->persist($metodo4);

            $this->em->persist($metodosEspecifico);
            $this->em->persist($metodosEspecifico2);
            $this->em->persist($metodosEspecifico3);
            $this->em->persist($metodosEspecifico4);
            $this->em->persist($metodosEspecifico5);
            $this->em->persist($metodosEspecifico6);
            $this->em->persist($metodosEspecifico7);
            $this->em->persist($metodosEspecifico8);

            $division=new Division;
            $division->setNombre('Ligero');

            $division2=new Division;
            $division2->setNombre('Welter');

            $division3=new Division;
            $division3->setNombre('Pluma');

            $this->em->persist($division);
            $this->em->persist($division2);
            $this->em->persist($division3);

            $peleador=new Peleador;
            $peleador->setNombre('Charles');
            $peleador->setAlias('Do Bronx');
            $peleador->setApellido('Oliveira');
            $peleador->setEdad('32');
            $peleador->setAltura('178');
            $peleador->setPeso('71');
            $peleador->setDivision($division);

            $peleador2=new Peleador;
            $peleador2->setNombre('Justin');
            $peleador2->setAlias('The Highlight');
            $peleador2->setApellido('Gaethje');
            $peleador2->setEdad('33');
            $peleador2->setAltura('180');
            $peleador2->setPeso('70');
            $peleador2->setDivision($division);

            $peleador3=new Peleador;
            $peleador3->setNombre('Kamaru');
            $peleador3->setAlias('The Nigerian Nightmare');
            $peleador3->setApellido('Usman');
            $peleador3->setEdad('35');
            $peleador3->setAltura('183');
            $peleador3->setPeso('77');
            $peleador3->setDivision($division2);

            $peleador4=new Peleador;
            $peleador4->setNombre('Jorge');
            $peleador4->setAlias('Gamebread');
            $peleador4->setApellido('Masvidal');
            $peleador4->setEdad('37');
            $peleador4->setAltura('180');
            $peleador4->setPeso('77');
            $peleador4->setDivision($division2);

            $peleador5=new Peleador;
            $peleador5->setNombre('Alexander');
            $peleador5->setAlias('The Great');
            $peleador5->setApellido('Volkanovski');
            $peleador5->setEdad('33');
            $peleador5->setAltura('168');
            $peleador5->setPeso('66');
            $peleador5->setDivision($division3);

            $peleador6=new Peleador;
            $peleador6->setNombre('Jung');
            $peleador6->setAlias('The Korean Zombie');
            $peleador6->setApellido('Chan-Sung');
            $peleador6->setEdad('35');
            $peleador6->setAltura('17');
            $peleador6->setPeso('66');
            $peleador6->setDivision($division3);

            $this->em->persist($peleador);
            $this->em->persist($peleador2);
            $this->em->persist($peleador3);
            $this->em->persist($peleador4);
            $this->em->persist($peleador5);
            $this->em->persist($peleador6);

            $evento= new Evento;
            $evento->setLocalidad('Phoenix, Arizona');
            $evento->setNombre('UFC 274: Oliveira vs Gaethje');
            $evento->setFecha(new DateTime('07-05-2022'));
            $evento->setImagen('ufc274.jpg');

            $evento2= new Evento;
            $evento2->setLocalidad('Jacksonville, Florida');
            $evento2->setNombre('UFC 273: Volkanovski vs The Korean Zombie');
            $evento2->setFecha(new DateTime('09-04-2022'));
            $evento2->setImagen('ufc273.jpg');

            $evento3= new Evento;
            $evento3->setLocalidad('Jacksonville, Florida');
            $evento3->setNombre('UFC 261: Usman vs Masvidal');
            $evento3->setFecha(new DateTime('24-04-2021'));
            $evento3->setImagen('ufc261.jpg');

            $this->em->persist($evento);
            $this->em->persist($evento2);
            $this->em->persist($evento3);

            $combate=new Combate;
            $combate->setRounds('5');
            $combate->setDivision($division2);
            $combate->setEvento($evento3);

            $combate2=new Combate;
            $combate2->setRounds('5');
            $combate2->setDivision($division);
            $combate2->setEvento($evento);

            $combate3=new Combate;
            $combate3->setRounds('5');
            $combate3->setDivision($division3);
            $combate3->setEvento($evento2);

            $this->em->persist($combate);
            $this->em->persist($combate2);
            $this->em->persist($combate3);

            $combatePeleador=new CombatePeleador;
            $combatePeleador->setPeleador($peleador5);
            $combatePeleador->setCombate($combate3);
            $combatePeleador->setGanador(true);
            $combatePeleador->setRound('4');
            $combatePeleador->setMetodo($metodo);
            $combatePeleador->setMetodoEspecifico($metodosEspecifico);
            
            $combatePeleador2=new CombatePeleador;
            $combatePeleador2->setPeleador($peleador6);
            $combatePeleador2->setCombate($combate3);
            $combatePeleador2->setGanador(false);
            $combatePeleador2->setRound('4');
            $combatePeleador2->setMetodo($metodo);
            $combatePeleador2->setMetodoEspecifico($metodosEspecifico);

            $combatePeleador3=new CombatePeleador;
            $combatePeleador3->setPeleador($peleador3);
            $combatePeleador3->setCombate($combate);
            $combatePeleador3->setGanador(true);
            $combatePeleador3->setRound('4');
            $combatePeleador3->setMetodo($metodo2);
            $combatePeleador3->setMetodoEspecifico($metodosEspecifico3);

            $combatePeleador4=new CombatePeleador;
            $combatePeleador4->setPeleador($peleador4);
            $combatePeleador4->setCombate($combate);
            $combatePeleador4->setGanador(false);
            $combatePeleador4->setRound('4');
            $combatePeleador4->setMetodo($metodo2);
            $combatePeleador4->setMetodoEspecifico($metodosEspecifico3);

            $this->em->persist($combatePeleador);
            $this->em->persist($combatePeleador3);
            $this->em->persist($combatePeleador4);
            $this->em->persist($combatePeleador2);

            $this->em->flush();
            
            $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
