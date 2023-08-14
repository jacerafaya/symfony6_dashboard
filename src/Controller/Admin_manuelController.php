<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Admin_manuelController extends AbstractController
{
    #[Route('/admin_manuel', name: 'app_admin_accueil')]
    public function index(): Response
    {
        return $this->render('admin_manuel/index.html.twig', [
            'controller_name' => 'accueil_controller',
        ]);
    }

    #[Route('/admin_manuel/article', name: 'app_admin_manuel')]
    public function indexadmin(): Response
    {
        return $this->render('admin_manuel/admin_manuel.article.html.twig', [
            'controller_name' => 'Admin_manuelController',
        ]);
    }
}


