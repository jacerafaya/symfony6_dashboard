<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;


class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(EntityManagerInterface $entityManager)
    {   
        $articles = $entityManager->getRepository(Article::class)->findAll();
        

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' =>$articles,
        ]);
    }

    #[Route('/article/{slug}', name: 'app_article_affichage')]
    public function affichage($slug, EntityManagerInterface $entityManager)
    {   
        $article = $entityManager->getRepository(Article::class)->findOneBy(['slug'=>$slug]);
        

        return $this->render('article/affichage.html.twig', [
            'controller_name' => 'ArticleController',
            'article' =>$article,
            'slug'=>$slug,
        ]);
    }

    #[Route('/ajouter_article', name: 'ajouter_article')]
    public function ajouterArticle(Request $request, EntityManagerInterface $manager)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $article->setdate_ajout(new \DateTime('@'.strtotime('now')));
                $slugify = new Slugify();
                $article->setSlug($slugify->slugify($article->getTitre()));
         

                $manager->persist($article);
                $manager->flush();

                return $this->redirectToRoute('app_article');
        }
        return $this->render('article/ajout.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/article/modifier/{id}', name: 'modifier_article')]
    public function update(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);
    
        if (!$article) {
            throw $this->createNotFoundException(
                'pas des articles avec ce id '.$id
            );
        }
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setdate_modif(new \DateTime('@'.strtotime('now')));
            $slugify = new Slugify();
            $article->setSlug($slugify->slugify($article->getTitre()));
            
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article');
    }
    return $this->render('article/modifier.html.twig', [
        'controller_name' => 'ArticleController',
        'form' => $form->createView(),
        'article' => $article,
        'id' => $article->getId(),
    ]);
    }

    #[Route('/article/supprimer/{id}', name: 'supprimer_article')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'pas des articles avec cet id '.$id
            );
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('app_article', [
            'id' => $article->getId()
        ]);
    }

}
