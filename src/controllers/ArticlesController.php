<?php
namespace Controllers;

use Models\Repository\ArticlesRepository;

class ArticlesController extends Controller
{
    //Déclaration de la propriété privée 
    public function listArticles()
    {
        $repository = new ArticlesRepository();
        $repository -> getArticles();
        echo $this->twig->render('portfolio.html.twig');

    }
} 