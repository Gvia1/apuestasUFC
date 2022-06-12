<?php

namespace App\Controller;

use App\Entity\Peleador;
use App\Form\PeleadorType;
use App\Repository\PeleadorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/peleador")
 */
class PeleadorController extends AbstractController
{
    /**
     * @Route("/", name="app_peleador_index", methods={"GET"})
     */
    public function index(PeleadorRepository $peleadorRepository): Response
    {
        return $this->render('peleador/index.html.twig', [
            'peleadores' => $peleadorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_peleador_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PeleadorRepository $peleadorRepository): Response
    {
        $peleador = new Peleador();
        $form = $this->createForm(PeleadorType::class, $peleador);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $peleadorRepository->add($peleador, true);

            return $this->redirectToRoute('app_peleador_new', ['peleadores' => $peleadorRepository->findAll(),], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('peleador/new.html.twig', [
            'peleador' => $peleador,
            'form' => $form,
            'peleadores' => $peleadorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_peleador_show", methods={"GET"})
     */
    public function show(Peleador $peleador): Response
    {
        return $this->render('peleador/show.html.twig', [
            'peleador' => $peleador,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_peleador_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Peleador $peleador, PeleadorRepository $peleadorRepository): Response
    {
        $form = $this->createForm(PeleadorType::class, $peleador);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $peleadorRepository->add($peleador, true);

            return $this->redirectToRoute('app_peleador_new', ['peleadores' => $peleadorRepository->findAll(),], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('peleador/edit.html.twig', [
            'peleador' => $peleador,
            'form' => $form,
            'peleadores' => $peleadorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_peleador_delete", methods={"POST"})
     */
    public function delete(Request $request, Peleador $peleador, PeleadorRepository $peleadorRepository): Response
    {
            $peleadorRepository->remove($peleador, true);

        return $this->redirectToRoute('app_peleador_new', ['peleadores' => $peleadorRepository->findAll(),], Response::HTTP_SEE_OTHER);
    }
}
