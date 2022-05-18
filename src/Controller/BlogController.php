<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $repo ): Response
    {
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('blog/home.html.twig',[
            'title' => "Bienvenu les amis !",
            'age' => 31,
        ]);
    }
    /** 
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(ArticleRepository $repo, $id) {
        $articles = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $articles
        ]);
    }
}
