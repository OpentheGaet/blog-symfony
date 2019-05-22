<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    /**
     * @Route("/admin/login", name="ad_connecter")
     * 
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function adLogin(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('Web/ad_connecter/index.html.twig', [
            'username' => $username,
            'state'    => $error
        ]);
    }

    /**
     * @Route("/admin/logout", name="ad_logout")
     *
     * @return void
     */
    public function adLogout() {}
}
