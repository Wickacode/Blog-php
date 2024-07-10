<?php
namespace Controllers;

use Models\Entity\Article;
use Models\Repository\ArticlesRepository;
use Models\Entity\Comment;
use Models\Repository\CommentsRepository;


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
        $repositoryArticles = new ArticlesRepository();
        $article = $repositoryArticles->getArticle($id);
        $repositoryComments = new CommentsRepository();
        $comments = $repositoryComments->getComments($id);
        echo $this->twig->render('article.html.twig', ["article" => $article, "comments" => $comments]);
    }

    public function createArticle()
    {
        $date = date('Y-m-d');
        //Gestion de la récupération et de la sauvegarde des données 
        if (isset($_POST['submitArticle'])) {
            if (isset($_FILES["uploadfile"]["name"]) && !empty($_FILES["uploadfile"]["name"])) {
                $filename = $_FILES["uploadfile"]["name"];
                $folder = "C:/wamp64/www/Blog-php/public/img/upload/" . $filename;
                if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $folder));
                $stockImg = "http://localhost/BLOG-PHP/public/img/upload/" . $filename;
            }
            if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content']) && !empty($_POST['altImage'])) {
                $article = new Article([
                    "title" => $_POST['title'],
                    "chapo" => $_POST['chapo'],
                    "content" => $_POST['content'],
                    "date_publication" => $date,
                    "date_modification" => $date,
                    "image" => $stockImg,
                    "alt" => $_POST['altImage']
                ]);
                $repository = new ArticlesRepository();
                $repository->addArticle($article);
                $validAdd = "L'article a bien été ajouté";
            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->twig->render('createArticle.html.twig', ["error" => $error]);
            }
        }
        if (isset($validAdd)) {
            echo $this->twig->render('createArticle.html.twig', ["validAdd" => $validAdd]);
        } else {
            echo $this->twig->render('createArticle.html.twig');
        }

    }

    public function createComment()
    {
        if (isset($_POST['submitComment'])) {
            if (!empty($_POST['message'])) {
                $comment = new Comment([
                    "content" => $_POST['message'],
                    "id_user"=> (int)$_SESSION['userId'],
                    "id_article" => (int)$_GET["id_article"]
                ]);
                $repositoryComment = new CommentsRepository();
                $repositoryComment->addComment($comment);
                $validAddComment = "Le commentaire est en cours de validation";
                return header('location: http://localhost/BLOG-PHP/public/index.php?action=article&id_article=' . $_GET["id_article"]);

            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->twig->render('createArticle.html.twig', ["error" => $error]);
            }
        }
    }
    public function listComments()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->listComments();
        
        echo $this->twig->render('listComments.html.twig', ["comments" => $comments]);
    }

    public function approveCom()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->validCom();
        
        echo $this->twig->render('listComments.html.twig', ["comments" => $comments]);
    }

    public function deleteCom()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->refuseCom();
        
        echo $this->twig->render('listComments.html.twig', ["comments" => $comments]);
    }

}