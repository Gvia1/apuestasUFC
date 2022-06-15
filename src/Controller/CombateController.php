<?php

namespace App\Controller;

use App\Entity\Apuesta;
use App\Entity\Combate;
use App\Entity\CombatePeleador;
use App\Form\ApuestaType;
use App\Form\CombatePeleadorType;
use App\Form\CombateType;
use App\Repository\CombatePeleadorRepository;
use App\Repository\CombateRepository;
use App\Repository\PeleadorRepository;
use App\Service\PagarApuestas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/combate")
 */
class CombateController extends AbstractController
{
    /**
     * @Route("/", name="app_combate_index", methods={"GET"})
     */
    public function index(CombateRepository $combateRepository): Response
    {
        return $this->render('combate/index.html.twig', [
            'combates' => $combateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_combate_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CombateRepository $combateRepository, CombatePeleadorRepository $combatePeleadorRepository, PeleadorRepository $peleadorRepository, EntityManagerInterface $em): Response
    {
        $combate = new Combate();
        $form = $this->createForm(CombateType::class, $combate);
        $form->handleRequest($request);
        
        $formPeleadores=$this->createForm(CombatePeleadorType::class, new CombatePeleador);
        
        if ($form->isSubmitted()) {
            $peleadoresId[]=$request->request->get('combate_peleador');
            $peleador1=$peleadorRepository->findOneById($peleadoresId[0]['peleador']);
            $peleador2=$peleadorRepository->findOneById($peleadoresId[0]['peleador2']);

            $combate->setNombre($peleador1->__toString().' Vs '.$peleador2->__toString());
            $em->persist($combate);
            $em->flush();

            $combatePeleador=new CombatePeleador;
            $combatePeleador->setCombate($combate);
            $combatePeleador->setPeleador($peleador1);
            $em->persist($combatePeleador);
            $em->flush();

            $combatePeleador=new CombatePeleador;
            $combatePeleador->setCombate($combate);
            $combatePeleador->setPeleador($peleador2);
            $em->persist($combatePeleador);
            $em->flush();
            
            return $this->redirectToRoute('app_combate_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate/new.html.twig', [
            'combate' => $combate,
            'form' => $form,
            'formPeleadores'=> $formPeleadores,
            'combates' => $combateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_combate_show", methods={"GET"})
     */
    public function show(Combate $combate): Response
    {
        return $this->render('combate/show.html.twig', [
            'combate' => $combate,
        ]);
    }

    /**
     * @Route("/{id}/detalles", name="app_combate_detalles", methods={"GET","POST"})
     */
    public function detalles(Combate $combate, CombatePeleadorRepository $combatePeleadorRepository, Request $request, EntityManagerInterface $em, PagarApuestas $srv): Response
    {
        $registrosCombate=$combatePeleadorRepository->findBy(['combate'=>$combate->getId()]);
        foreach($registrosCombate as $registro){
            $peleadores[]=$registro->getPeleador();
            if($registro->isGanador() === true){
                $resultado=$registro;
            }
        }
        $favorito=$srv->calcularFavorito($registrosCombate);

        return $this->renderForm('combate/detalles.html.twig', [
            'peleadores'=>$peleadores,
            'combate' => $combate,
            'evento'=>$combate->getEvento(),
            'favorito'=>$favorito,
            'resultado'=>$resultado

        ]);

    }

    /**
     * @Route("/{id}/ganador", name="app_combate_ganador", methods={"GET","POST"})
     */
    public function ganador(Combate $combate, CombatePeleadorRepository $combatePeleadorRepository, Request $request,CombateRepository $combateRepository, PeleadorRepository $peleadorRepository, EntityManagerInterface $em): Response
    {

        $registrosCombate=$combatePeleadorRepository->findBy(['combate'=>$combate->getId()]);

        foreach($registrosCombate as $registro){
            $peleadores[]=$registro->getPeleador();
        }
        $resultado=new Apuesta;
        $rounds=$combate->getRounds();
        $form = $this->createForm(ApuestaType::class, $resultado, ['peleadores'=>$peleadores, 'rounds' =>$rounds]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            foreach($registrosCombate as $registro){
                if($registro->getPeleador()===$resultado->getGanador()){
                    $registro->setGanador(true);
                    $registro->getPeleador()->setVictorias($registro->getPeleador()->getVictorias()+1);

                    if($resultado->getRound() !== null){
                        $registro->setRound($resultado->getRound());
                    }
                    if($resultado->getMetodo() !== null){
                        $registro->setMetodo($resultado->getMetodo());
                    }
                    if($resultado->getMetodoEspecifico() !== null){
                        $registro->setMetodoEspecifico($resultado->getMetodoEspecifico());
                    }
                    $em->persist($registro);
                }
                else{
                    $registro->setGanador(false);
                    $registro->getPeleador()->setDerrotas($registro->getPeleador()->getDerrotas()+1);
                    if($resultado->getRound() !== null){
                        $registro->setRound($resultado->getRound());
                    }
                    if($resultado->getMetodo() !== null){
                        $registro->setMetodo($resultado->getMetodo());
                    }
                    if($resultado->getMetodoEspecifico() !== null){
                        $registro->setMetodoEspecifico($resultado->getMetodoEspecifico());
                    }
                    $em->persist($registro);

                }
            }
            
            $em->flush();

            return $this->redirectToRoute('app_combate_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate/ganador.html.twig', [
            'resultado' => $resultado,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_combate_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Combate $combate, CombateRepository $combateRepository,PeleadorRepository $peleadorRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CombateType::class, $combate);
        $form->handleRequest($request);

        $formPeleadores=$this->createForm(CombatePeleadorType::class, new CombatePeleador);

        if ($form->isSubmitted()) {
            $peleadoresId[]=$request->request->get('combate_peleador');
            $peleador1=$peleadorRepository->findOneById($peleadoresId[0]['peleador']);
            $peleador2=$peleadorRepository->findOneById($peleadoresId[0]['peleador2']);

            $combate->setNombre($peleador1->__toString().' Vs '.$peleador2->__toString());
            $em->persist($combate);
            $em->flush();

            $combatePeleador=new CombatePeleador;
            $combatePeleador->setCombate($combate);
            $combatePeleador->setPeleador($peleador1);
            $em->persist($combatePeleador);
            $em->flush();

            $combatePeleador=new CombatePeleador;
            $combatePeleador->setCombate($combate);
            $combatePeleador->setPeleador($peleador2);
            $em->persist($combatePeleador);
            $em->flush();

            return $this->redirectToRoute('app_combate_new', ['combates' => $combateRepository->findAll()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate/edit.html.twig', [
            'combate' => $combate,
            'form' => $form,
            'combates' => $combateRepository->findAll(),
            'formPeleadores'=> $formPeleadores,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_combate_delete", methods={"POST","GET"})
     */
    public function delete(Request $request, Combate $combate, CombateRepository $combateRepository): Response
    {
            $combateRepository->remove($combate, true);

        return $this->redirectToRoute('app_combate_new', ['combates' => $combateRepository->findAll()], Response::HTTP_SEE_OTHER);
    }

}
