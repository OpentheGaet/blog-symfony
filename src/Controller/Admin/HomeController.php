<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin/home", name="ad_home")
     * 
     * @return void
     */
    public function index()
    {
        return $this->render('Admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
