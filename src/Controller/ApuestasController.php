<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApuestasController extends AbstractController
{
    /**
     * @Route("/", name="app_apuestas")
     */
    public function index(): Response
    {
        return $this->render('apuestas/index.html.twig', [
            'controller_name' => 'ApuestasController',
        ]);
    }
}
