<?php

namespace App\Controller;
use App\Entity\Apuesta;
use App\Entity\CombatePeleador;
use App\Entity\MovimientosFinancieros;
use App\Entity\Peleador;
use App\Form\ApuestaType;
use App\Repository\ApuestaRepository;
use App\Repository\CombatePeleadorRepository;
use App\Repository\CombateRepository;
use App\Repository\PeleadorRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/apuesta")
 */
class ApuestaController extends AbstractController
{
    /**
     * @Route("/", name="app_apuesta_index", methods={"GET"})
     */
    public function index(ApuestaRepository $apuestaRepository): Response
    {
        return $this->render('apuesta/index.html.twig', [
            'apuestas' => $apuestaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="app_apuesta_new", methods={"GET", "POST"},requirements={"id":"\d+"})
     */
    public function new(Request $request, ApuestaRepository $apuestaRepository, CombateRepository $combateRepository, CombatePeleadorRepository $combatePeleadorRepository, PeleadorRepository $peleadorRepository,EntityManagerInterface $em): Response
    {
        $apuesta = new Apuesta();
        //Recoge el id del combate
        $combateId=$request->attributes->get('id');
        $peleadoresId=[];
        //Hace la consulta para recoger la entidad del combate con ese id
        $combate=$combateRepository->find($combateId);

        //Recoge todos los peleadores de ese combate
        $registrosCombate=$combatePeleadorRepository->findBy(['combate'=>$combate->getId()]);

        foreach($registrosCombate as $registro){
            $peleadoresId[]=$registro->getPeleador()->getId();
        }

        $peleadores=$peleadorRepository->findPeleadoresCombate($peleadoresId);
        //recoge los rounds de ese combate
        $rounds=$combate->getRounds();
        //crea el formulario
        $form = $this->createForm(ApuestaType::class, $apuesta, ['peleadores'=>$peleadores, 'rounds' =>$rounds]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user=$this->getUser();
            //Crea el movimiento
            if($apuesta->getCantidad() <= $user->getSaldo()){
                $movimiento=new MovimientosFinancieros;
                $movimiento->setUsuario($user);
                $movimiento->setImporte($apuesta->getCantidad()*-1);
                $movimiento->setConcepto('Apuesta en el combate: '.$combate->getNombre());

                $apuesta->setCombate($combate);
                $apuesta->setUsuario($user);
                $apuesta->setCobrada(false);
                $apuesta->setFechaCreacion(new DateTime());
                
                $em->persist($apuesta);
                $em->persist($movimiento);
                $em->flush();

                return $this->redirectToRoute('app_evento_combates', ['id' =>$combate->getEvento()->getId()], Response::HTTP_SEE_OTHER);
            }
            else{
                $this->addFlash(
                    'warning',
                    'Saldo insuficiente!'
                );
                return $this->renderForm('apuesta/new.html.twig', [
                    'apuesta' => $apuesta,
                    'form' => $form,
                ]);
            }
            
        }

        return $this->renderForm('apuesta/new.html.twig', [
            'apuesta' => $apuesta,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/pruebas", name="app_pruebas", methods={"GET","POST"})
     */
    public function pruebas(ApuestaRepository $apuestaRepository): Response
    {
        dump($this->getUser());die();
    }

    /**
     * @Route("/{id}", name="app_apuesta_show", methods={"GET"})
     */
    public function show(Apuesta $apuestum): Response
    {
        return $this->render('apuesta/show.html.twig', [
            'apuestum' => $apuestum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_apuesta_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Apuesta $apuestum, ApuestaRepository $apuestaRepository): Response
    {
        $form = $this->createForm(ApuestaType::class, $apuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apuestaRepository->add($apuestum, true);

            return $this->redirectToRoute('app_apuesta_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('apuesta/edit.html.twig', [
            'apuestum' => $apuestum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_apuesta_delete", methods={"POST"})
     */
    public function delete(Request $request, Apuesta $apuestum, ApuestaRepository $apuestaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apuestum->getId(), $request->request->get('_token'))) {
            $apuestaRepository->remove($apuestum, true);
        }

        return $this->redirectToRoute('app_apuesta_index', [], Response::HTTP_SEE_OTHER);
    }
}
