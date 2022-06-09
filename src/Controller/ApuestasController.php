<?php

namespace App\Controller;

use App\Entity\Evento;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response as FlexResponse;

class ApuestasController extends AbstractController
{
    /**
     * @Route("/", name="app_apuestas")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $eventos=$em->getRepository(Evento::class)->findUltimosEventos();

        return $this->render('apuestas/index.html.twig', [
            'controller_name' => 'ApuestasController',
            'eventos' => $eventos
        ]);
    }
}
