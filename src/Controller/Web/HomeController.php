<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return void
     */
    public function index()
    {
        return $this->render('Web/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
