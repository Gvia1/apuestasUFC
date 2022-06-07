<?php

namespace App\Controller;

use App\Entity\Combate;
use App\Form\CombateType;
use App\Repository\CombateRepository;
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
    public function new(Request $request, CombateRepository $combateRepository): Response
    {
        $combate = new Combate();
        $form = $this->createForm(CombateType::class, $combate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $combateRepository->add($combate, true);

            return $this->redirectToRoute('app_combate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate/new.html.twig', [
            'combate' => $combate,
            'form' => $form,
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
     * @Route("/{id}/edit", name="app_combate_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Combate $combate, CombateRepository $combateRepository): Response
    {
        $form = $this->createForm(CombateType::class, $combate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $combateRepository->add($combate, true);

            return $this->redirectToRoute('app_combate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('combate/edit.html.twig', [
            'combate' => $combate,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_combate_delete", methods={"POST"})
     */
    public function delete(Request $request, Combate $combate, CombateRepository $combateRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$combate->getId(), $request->request->get('_token'))) {
            $combateRepository->remove($combate, true);
        }

        return $this->redirectToRoute('app_combate_index', [], Response::HTTP_SEE_OTHER);
    }

}
