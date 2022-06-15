<?php

namespace App\Controller;

use App\Service\PagarApuestas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PruebasController extends AbstractController
{
    /**
     * @Route("/pruebas", name="app_pruebas")
     */
    public function index(): Response
    {
        return $this->render('pruebas/index.html.twig', [
            'controller_name' => 'PruebasController',
        ]);
    }
    /**
     * @Route("/pagarApuestas", name="app_pagar_apuestas")
     */
    public function pagarApuestas(PagarApuestas $srv): Response
    {
        $apuestasPagadas=$srv->gestionarApuestas();
        
        $this->addFlash(
            'success',
            'Se han pagado '.$apuestasPagadas.' apuestas!'
        );
        return $this->render('pruebas/index.html.twig', [
            'controller_name' => 'PruebasController',
        ]);
    }
}
