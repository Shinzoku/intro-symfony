<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front_index')]
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findNLast(5);

        return $this->render('front/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
