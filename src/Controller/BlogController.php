<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
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
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request): Response
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title')
                     ->add('content')
                     ->add('image')
                     ->getForm();

        $form->handleRequest($request);

        dump($article);

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }

    /** 
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(ArticleRepository $repo, $id): Response
    {
        $articles = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $articles
        ]);
    }

}
