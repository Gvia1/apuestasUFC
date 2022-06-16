<?php

namespace App\Controller;

use App\Entity\Division;
use App\Form\DivisionType;
use App\Repository\DivisionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/division")
 */
class DivisionController extends AbstractController
{
    /**
     * @Route("/", name="app_division_index", methods={"GET"})
     */
    public function index(DivisionRepository $divisionRepository): Response
    {
        return $this->render('division/index.html.twig', [
            'divisions' => $divisionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_division_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DivisionRepository $divisionRepository): Response
    {
        $division = new Division();
        $form = $this->createForm(DivisionType::class, $division);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $divisionRepository->add($division, true);
            
            $this->addFlash(
                'success',
                'División creada correctamente!'
            );
            return $this->redirectToRoute('app_division_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('division/new.html.twig', [
            'division' => $division,
            'form' => $form,
            'divisiones' => $divisionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_division_show", methods={"GET"})
     */
    public function show(Division $division): Response
    {
        return $this->render('division/show.html.twig', [
            'division' => $division,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_division_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Division $division, DivisionRepository $divisionRepository): Response
    {
        $form = $this->createForm(DivisionType::class, $division);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $divisionRepository->add($division, true);

            $this->addFlash(
                'success',
                'División editada correctamente!'
            );

            return $this->redirectToRoute('app_division_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('division/edit.html.twig', [
            'division' => $division,
            'form' => $form,
            'divisiones' => $divisionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_division_delete", methods={"POST","GET"})
     */
    public function delete(Request $request, Division $division, DivisionRepository $divisionRepository): Response
    {
            $divisionRepository->remove($division, true);
            
            $this->addFlash(
                'success',
                'División borrada correctamente!'
            );

        return $this->redirectToRoute('app_division_new', ['divisiones' => $divisionRepository->findAll(),], Response::HTTP_SEE_OTHER);
    }
}
