<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $password=$request->request->get('secretpassword');
            if ($password=="123456"){
                $user->setRoles((array)"ROLE_ADMIN");
                $entityManager->persist($user);
                $entityManager->flush();
            }else{
                $user->setRoles((array)"ROLE_EDIT");
                $entityManager->persist($user);
                $entityManager->flush();
            }


            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authUtils): Response
    {
        $error=$authUtils->getLastAuthenticationError();
        $lastUsername=$authUtils->getLastAuthenticationError();


        return $this->render('registration/login.html.twig', ['error'=>$error,
            'last_username'=>$lastUsername
        ]);
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(Security $security): Response
    {
        if($this->getUser()){
            $security->logout(false);
        }

        return $this->redirectToRoute('app_games_home');

    }
}
