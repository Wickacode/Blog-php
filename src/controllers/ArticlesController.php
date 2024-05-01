<?php
namespace App\src\controllers;


class Articles extends AbstractController
{
    public function listArticles()
    {
        //on appelle la méthode render() de la classe parente (AbstractController) en passant le nom de la vue à afficher
        $this->render('listArticles');
    }
}