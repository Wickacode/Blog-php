<?php
namespace Controllers;

use Models\Entity\Article;
use Models\Repository\ArticlesRepository;
use DateTime;

class ArticlesController extends Controller
{
    //Déclaration de la propriété privée 
    public function listArticles()
    {
        $repository = new ArticlesRepository();
        $articles = $repository->getArticles();
        echo $this->twig->render('portfolio.html.twig', ["articles" => $articles]);
    }

    public function Article()
    {
        $id = $_GET["id_article"];
        $repository = new ArticlesRepository();
        $article = $repository->getArticle($id);
        echo $this->twig->render('article.html.twig', ["article" => $article]);
    }

    public function createArticle()
    {
        $date = date('Y-m-d');
        //Gestion de la récupération et de la sauvegarde des données 
        if (isset($_POST['submitArticle'])) {
            if (isset($_FILES["uploadfile"]["name"]) && !empty($_FILES["uploadfile"]["name"])) {
                $filename = $_FILES["uploadfile"]["name"];
                $folder = "C:/wamp64/www/Blog-php/public/img/upload/" . $filename;
                if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $folder))
                    ;
            }
            if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content']) && !empty($_POST['altImage'])) {
                $article = new Article([
                    "title" => $_POST['title'],
                    "chapo" => $_POST['chapo'],
                    "content" => $_POST['content'],
                    "date_publication" => $date,
                    "date_modification" => $date,
                    "image" => $filename,
                    "alt" => $_POST['altImage']
                ]);
                $repository = new ArticlesRepository();
                $repository->addArticle($article);
            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->twig->render('createArticle.html.twig', ["error" => $error]);
            }
        }
        echo $this->twig->render('createArticle.html.twig');
    }

}