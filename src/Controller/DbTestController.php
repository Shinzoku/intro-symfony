<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DbTestController extends AbstractController
{
    #[Route('/db/test', name: 'app_db_test')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // récupération du repository des catégories
        $repository = $doctrine->getRepository(Category::class);
        // récupération de la liste complète de toutes les catégories
        $categories = $repository->findAll();
        // inspection de la liste
        dump($categories);

        // récupération du repository des tags
        $repository = $doctrine->getRepository(Tag::class);
        // récupération de la liste complète de toutes les tags
        $tags = $repository->findAll();
        // inspection de la liste
        dump($tags);

        // récupération du repository des tags
        $repository = $doctrine->getRepository(Article::class);
        // récupération de la liste complète de toutes les tags
        $articles = $repository->findAll();
        // inspection de la liste
        dump($articles);
        
        // hack déguelace
        exit();
    }
}
