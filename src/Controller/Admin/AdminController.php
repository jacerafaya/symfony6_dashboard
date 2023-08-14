<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('base.admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/adminMenu', name: 'app_admin_menu')]
    public function indexMenu(): Response
    {
        return $this->render('/admin/menu.admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/adminArticle', name: 'app_admin_articles')]
    public function indexArticle(): Response
    {
        return $this->render('/admin/article.admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/adminCategorie', name: 'app_admin_categorie')]
    public function indexCategorie(): Response
    {
        return $this->render('/admin/categorie.admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
