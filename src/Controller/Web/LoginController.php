<?php

namespace App\Controller\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="connecter")
     * 
     * @param Authentification $utils
     * @param Request $request
     * @return void
     */
    public function Login(AuthenticationUtils $utils,Request $request)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('Web/home/index.html.twig', [
            'username' => $username,
            'state'    => $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     *
     * @return void
     */
    public function Logout() {}
}