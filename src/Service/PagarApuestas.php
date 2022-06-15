<?php

namespace App\Service;

use App\Entity\Apuesta;
use App\Entity\Combate;
use App\Entity\CombatePeleador;
use App\Entity\Evento;
use App\Entity\MovimientosFinancieros;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class PagarApuestas
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

    }
    
    public function gestionarApuestas()
    {
        $now= new DateTime();
        $fechaFin=$now;
        $fechaInicio = clone $fechaFin;
        $fechaInicio->modify('-2 month');
        $apuestasPagadas=0;

        $eventos=$this->em->getRepository(Evento::class)->findEventosApuestas($fechaFin, $fechaInicio);
        if($eventos !== null){
            foreach($eventos as $evento){
                    $combates=$this->em->getRepository(Combate::class)->findByEvento($evento->getId());
                    if($combates !== null){
                    foreach($combates as $combate){
                        
                        $registrosCombates=$this->em->getRepository(CombatePeleador::class)->findBy(['combate'=>$combate->getId()]);
                        $favorito=$this->calcularFavorito($registrosCombates);

                        $registroGanador=$this->em->getRepository(CombatePeleador::class)->findOneBy(['combate'=>$combate->getId(), 'ganador'=>true]);
                        $apuestas=$this->em->getRepository(Apuesta::class)->findBy(['combate'=> $combate->getId(), 'cobrada'=>false]);

                        if($apuestas !== null){ 
                            foreach($apuestas as $apuesta){
                                if($apuesta !==null){
                                    $pago=$this->calcularPago($apuesta, $registroGanador,$favorito);
                                    $this->pagarApuestas($apuesta, $pago);

                                    $apuestasPagadas++;
                                }else{
                                    continue;
                                }
                            }
                        }else{
                            continue;
                        }
                    }
                }else{
                    continue;
                }
            }
        }
        return $apuestasPagadas;
    }
    
    public function calcularFavorito($registrosCombates)
    {
        $peleador1=$registrosCombates[0]->getPeleador();
        $peleador2=$registrosCombates[1]->getPeleador();

        $apuestasPeleador1=$this->em->getRepository(Apuesta::class)->findBy(['ganador'=> $peleador1->getId()]);
        $apuestasPeleador2=$this->em->getRepository(Apuesta::class)->findBy(['ganador'=> $peleador2->getId()]);
        
        $numApuestasPeleador1=count($apuestasPeleador1);
        $numApuestasPeleador2=count($apuestasPeleador2);

        if($numApuestasPeleador1 > $numApuestasPeleador2){
            $favorito=$peleador1;
        }
        elseif($numApuestasPeleador2 > $numApuestasPeleador1){
            $favorito=$peleador2;
        }
        else{
            $favorito=null;
        }

        return $favorito;
        
    }

    public function calcularPago($apuesta, $registroGanador, $favorito)
    {
        $cuota=$apuesta->getCantidad();

        if($apuesta->getGanador() === $registroGanador->getPeleador()){

            $cuota=$cuota*0.5;

            if($apuesta->getMetodo() === $registroGanador->getMetodo()){
                $cuota=$cuota*1.5;
            }
            if($apuesta->getMetodoEspecifico() === $registroGanador->getMetodoEspecifico()){
                $cuota=$cuota*1.5;
            }
            if($apuesta->getRound() === $registroGanador->getRound()){
                $cuota=$cuota*1.5;
            }
            if($apuesta->getGanador() !== $favorito){
                $cuota=$cuota*1.5;
            }else{
                $cuota=$cuota*0.5;
            }
            $pago=$cuota+$apuesta->getCantidad();
        }
        else{
            $pago=0;
        }

        return $pago;
    }

    public function pagarApuestas($apuesta, $pago){
        $usuario=$apuesta->getUsuario();
        $nombreEvento=$apuesta->getCombate()->getEvento()->getNombre();
        $nombreCombate=$apuesta->getCombate()->getNombre();
        
        $movimiento=new MovimientosFinancieros;
        $movimiento->setUsuario($usuario);
        $movimiento->setConcepto('Ganancias de la apuesta con id '.$apuesta->getId().' del combate '.$nombreCombate.' del evento '.$nombreEvento);
        $movimiento->setImporte($pago);
        
        $apuesta->setCobrada(true);

        $this->em->persist($movimiento);
        $this->em->persist($apuesta);

        $this->em->flush();
    }
}