<?php

namespace App\Controller;

use App\Entity\MovimientosFinancieros;
use App\Form\MovimientosFinancierosType;
use App\Repository\MovimientosFinancierosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movimientos/financieros")
 */
class MovimientosFinancierosController extends AbstractController
{
    /**
     * @Route("/", name="app_movimientos_financieros_index", methods={"GET"})
     */
    public function index(MovimientosFinancierosRepository $movimientosFinancierosRepository): Response
    {
        return $this->render('movimientos_financieros/index.html.twig', [
            'movimientos_financieros' => $movimientosFinancierosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_movimientos_financieros_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MovimientosFinancierosRepository $movimientosFinancierosRepository): Response
    {
        $movimientosFinanciero = new MovimientosFinancieros();
        $form = $this->createForm(MovimientosFinancierosType::class, $movimientosFinanciero);
        $form->handleRequest($request);
        $user=$this->getUser();
        if ($form->isSubmitted()) {
            $movimientosFinanciero->setUsuario($user);
            $movimientosFinanciero->setConcepto('Ingreso');
            $movimientosFinancierosRepository->add($movimientosFinanciero, true);

            return $this->redirectToRoute('app_user_edit', ['id'=>$user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('movimientos_financieros/new.html.twig', [
            'movimientos_financiero' => $movimientosFinanciero,
            'form' => $form,
            'movimientos' => $user->getMovimientosFinancieros(),
            'user'=>$user
        ]);
    }

    /**
     * @Route("/{id}", name="app_movimientos_financieros_show", methods={"GET"})
     */
    public function show(MovimientosFinancieros $movimientosFinanciero): Response
    {
        return $this->render('movimientos_financieros/show.html.twig', [
            'movimientos_financiero' => $movimientosFinanciero,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_movimientos_financieros_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, MovimientosFinancieros $movimientosFinanciero, MovimientosFinancierosRepository $movimientosFinancierosRepository): Response
    {
        $form = $this->createForm(MovimientosFinancierosType::class, $movimientosFinanciero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movimientosFinancierosRepository->add($movimientosFinanciero, true);

            return $this->redirectToRoute('app_movimientos_financieros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('movimientos_financieros/edit.html.twig', [
            'movimientos_financiero' => $movimientosFinanciero,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_movimientos_financieros_delete", methods={"POST"})
     */
    public function delete(Request $request, MovimientosFinancieros $movimientosFinanciero, MovimientosFinancierosRepository $movimientosFinancierosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movimientosFinanciero->getId(), $request->request->get('_token'))) {
            $movimientosFinancierosRepository->remove($movimientosFinanciero, true);
        }

        return $this->redirectToRoute('app_movimientos_financieros_index', [], Response::HTTP_SEE_OTHER);
    }
}
