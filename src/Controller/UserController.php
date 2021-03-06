<?php

namespace App\Controller;

use App\Entity\MovimientosFinancieros;
use App\Entity\User;
use App\Form\UserType;
use App\Form\CambiarContrasenaType;
use App\Form\MovimientosFinancierosType;
use App\Repository\ApuestaRepository;
use App\Repository\MovimientosFinancierosRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository, ApuestaRepository $apuestaRepository, MovimientosFinancierosRepository $movimientosFinancierosRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_edit', ['id'=>$user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'apuestas' => $apuestaRepository->findByUsuario($user->getId()),
            'movimientos' => $movimientosFinancierosRepository->findByUsuario($user->getId()),
            'saldo'=>$user->getSaldo()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_user_delete", methods={"POST","GET"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
            $userRepository->remove($user, true);

            $session = $this->get('session');
          $session = new Session();
          $session->invalidate();
          
        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/cambiarContrasena", name="app_cambiar_contrasena", methods={"GET", "POST"})
     */
    public function cambiarContrasena(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        

        $form = $this->createForm(CambiarContrasenaType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $contrasenas=$request->request->get('cambiar_contrasena');
            if($userPasswordHasher->isPasswordValid($user, $contrasenas['contrasenaActual'])){
                if($contrasenas['password']['first']===$contrasenas['password']['second']){
                    $user->setPassword(
                        $userPasswordHasher->hashPassword(
                                $user,
                                $contrasenas['password']['first']
                            )
                        );
                        $userRepository->add($user, true);
                    $this->addFlash(
                        'success',
                        'Contrase??a cambiada correctamente!'
                    ); 
                    return $this->redirectToRoute('app_user_edit', ['id'=>$user->getId()], Response::HTTP_SEE_OTHER);
                }{
                    $this->addFlash(
                        'warning',
                        'Las contrase??as no coinciden!!'
                    ); 
                }
                
            }
            else{
                $this->addFlash(
                    'warning',
                    'Contrase??a actual erronea!'
                );      
            }                        
        }

        return $this->renderForm('user/cambiarContrasena.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);

    }
}
