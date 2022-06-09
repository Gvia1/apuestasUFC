<?php

namespace App\Controller;

use App\Entity\Combate;
use App\Entity\CombatePeleador;
use App\Entity\Evento;
use App\Form\CombatePeleadorType;
use App\Repository\CombatePeleadorRepository;
use App\Repository\CombateRepository;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/combatesEvento/")
 */
class CombatePeleadorController extends AbstractController
{
    /**
     * @Route("{id}/", name="app_combate_peleador_index", methods={"GET"})
     */
    public function index(Request $request ,CombatePeleadorRepository $combatePeleadorRepository, CombateRepository $combateRepository, EventoRepository $eventoRepository): Response
    {
        $eventoId=$request->attributes->get('id');
        $evento=$eventoRepository->find($eventoId);

        $combates=$combateRepository->findBy(['evento'=> $evento]);

        $peleadores=$combatePeleadorRepository->findPeleadoresCombates($combatesId);

        return $this->render('combate_peleador/index.html.twig', [
            'peleadores' => $peleadores,
            'evento' => $evento
        ]);
    }

    /**
     * @Route("/new", name="app_combate_peleador_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CombatePeleadorRepository $combatePeleadorRepository): Response
    {
        $combatePeleador = new CombatePeleador();
        $form = $this->createForm(CombatePeleadorType::class, $combatePeleador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $combatePeleadorRepository->add($combatePeleador, true);

            return $this->redirectToRoute('app_combate_peleador_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate_peleador/new.html.twig', [
            'combate_peleador' => $combatePeleador,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_combate_peleador_show", methods={"GET"})
     */
    public function show(CombatePeleador $combatePeleador): Response
    {
        return $this->render('combate_peleador/show.html.twig', [
            'combate_peleador' => $combatePeleador,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_combate_peleador_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CombatePeleador $combatePeleador, CombatePeleadorRepository $combatePeleadorRepository): Response
    {
        $form = $this->createForm(CombatePeleadorType::class, $combatePeleador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $combatePeleadorRepository->add($combatePeleador, true);

            return $this->redirectToRoute('app_combate_peleador_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate_peleador/edit.html.twig', [
            'combate_peleador' => $combatePeleador,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_combate_peleador_delete", methods={"POST"})
     */
    public function delete(Request $request, CombatePeleador $combatePeleador, CombatePeleadorRepository $combatePeleadorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$combatePeleador->getId(), $request->request->get('_token'))) {
            $combatePeleadorRepository->remove($combatePeleador, true);
        }

        return $this->redirectToRoute('app_combate_peleador_index', [], Response::HTTP_SEE_OTHER);
    }
}
