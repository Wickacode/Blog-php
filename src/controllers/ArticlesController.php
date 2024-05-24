<?php
namespace Controllers;

use Models\Repository\ArticlesRepository;

class ArticlesController
{
    //Déclaration de la propriété privée 
    private $twig;
    public function listArticles()
    {
        $repository = new ArticlesRepository();
        $repository->getArticles();
    }
} 