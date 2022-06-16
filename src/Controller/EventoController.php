<?php

namespace App\Controller;

use App\Entity\Combate;
use App\Entity\CombatePeleador;
use App\Entity\Evento;
use App\Form\EventoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eventos")
 */
class EventoController extends AbstractController
{
    /**
     * @Route("/", name="app_evento_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $eventos = $entityManager
            ->getRepository(Evento::class)
            ->findAll();
        
        return $this->render('evento/index.html.twig', [
            'eventos' => $eventos,
        ]);
    }

    /**
     * @Route("/new", name="app_evento_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evento = new Evento();
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($evento);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Evento creado correctamente!'
            );
            return $this->redirectToRoute('app_evento_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evento/new.html.twig', [
            'evento' => $evento,
            'form' => $form,
            'eventos' => $entityManager->getRepository(Evento::class)->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="app_evento_show", methods={"GET"})
     */
    public function show(Evento $evento): Response
    {
        return $this->render('evento/show.html.twig', [
            'evento' => $evento,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_evento_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Evento $evento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($evento);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Evento editado correctamente!'
            );
            return $this->redirectToRoute('app_evento_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evento/edit.html.twig', [
            'evento' => $evento,
            'form' => $form,
            'eventos' => $entityManager->getRepository(Evento::class)->findAll()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_evento_delete", methods={"POST","GET"})
     */
    public function delete(Request $request, Evento $evento, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($evento);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Evento borrado correctamente!'
            );

        return $this->redirectToRoute('app_evento_new', ['eventos' => $entityManager->getRepository(Evento::class)->findAll()], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/combates", name="app_evento_combates", methods={"GET"})
     */
    public function eventoCombates(EntityManagerInterface $entityManager, Evento $evento): Response
    {
        $combates=$evento->getCombates();
        
        return $this->render('evento/combates.html.twig', [
            'combates' => $combates,
            'evento' => $evento
        ]);
    }
}
