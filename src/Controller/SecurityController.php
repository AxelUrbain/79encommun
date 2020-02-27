<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastMail = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_mail' => $lastMail,
            'error' => $error
        ]);
    }

    /**
     * @Route("/login_check", name="app_login_check")
     * @return void
     * @throws \Exception
     */
    public function loginCheckAction()
    {
        throw new \Exception('Unexpexted loginCheck action');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->render('home/index.html.twig');
    }

    public function registration()
    {
        return $this->render('security/login.html.twig',[
            'controller_name' => 'SecurityController',
        ]);
    }
}
