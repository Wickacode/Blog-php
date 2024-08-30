<?php
namespace Controllers;

use Models\Entity\Article;
use Models\Repository\ArticlesRepository;
use Models\Entity\Comment;
use Models\Repository\CommentsRepository;


class ArticlesController extends Controller
{
    private ArticlesRepository $articleRepository;
    private CommentsRepository $commentRepository;
    public function __construct()
    {
        $this->articleRepository = new ArticlesRepository();
        $this->commentRepository = new CommentsRepository();

    }

    public function listArticles():void
    {
        $articles = $this->articleRepository->getArticles();
        echo $this->render('portfolio.html.twig', ["articles" => $articles]);
    }

    public function Article():void
    {
        if (!empty($_GET['id_article'])) {
            $id = $_GET["id_article"];
            $article = $this->articleRepository->getArticle($id);
            if (!$article) {
                echo $this->render('error404.html.twig');
                return;
            }

            $comments = $this->commentRepository->getComments($id);
            echo $this->render('article.html.twig', ["article" => $article, "comments" => $comments]);
        } else {
            echo $this->render('error404.html.twig');
        }
    }

    public function createArticle():void
    {
        $date = date('Y-m-d');
        //Gestion de la récupération et de la sauvegarde des données 
        if (isset($_POST['submitArticle'])) {
            if (isset($_FILES["uploadfile"]["name"]) && !empty($_FILES["uploadfile"]["name"])) {
                $filename = $_FILES["uploadfile"]["name"];
                $folder = "C:/wamp64/www/Blog-php/public/img/upload/" . $filename;
                if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $folder))
                    ;
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
                $this->articleRepository->addArticle($article);
                $validAdd = "L'article a bien été ajouté";
            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->render('createArticle.html.twig', ["error" => $error]);
            }
        }
        if (isset($validAdd)) {
            echo $this->render('createArticle.html.twig', ["validAdd" => $validAdd]);
        } else {
            echo $this->render('createArticle.html.twig');
        }

    }

    public function getListArticles():void
    {
        $articlesPublish = $this->articleRepository->getArticlesPublishAdmin();
        $articlesNoPublish = $this->articleRepository->getArticlesNoPublishAdmin();

        echo $this->render('listArticles.html.twig', ["articlesPublish" => $articlesPublish, "articlesNoPublish" => $articlesNoPublish]);
    }

    public function publishAdminArticle():void
    {
        if (!empty($_GET['id_article'])) {
            $idArticle = $_GET['id_article'];
            $this->articleRepository->publishArticleSQL($idArticle);
            header('location:index.php?action=getListArticles');

        } else {
            echo $this->render('error404.html.twig');
        }
    }

    public function formUpdateArticle():void
    {
        if (!empty($_GET['id_article'])) {
            $idArticle = $_GET['id_article'];
            $article = $this->articleRepository->getArticle($idArticle);
            echo $this->render('updateArticle.html.twig', ["article" => $article]);

        } else {
            echo $this->render('error404.html.twig');
        }
    }

    public function updateArticle():void
    {
        $date = date('Y-m-d');
        if (isset($_POST['modifyArticle'])) {
            if (isset($_FILES["uploadfile"]["name"]) && !empty($_FILES["uploadfile"]["name"])) {
                $filename = $_FILES["uploadfile"]["name"];
                $folder = "C:/wamp64/www/Blog-php/public/img/upload/" . $filename;
                if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $folder))
                    ;
                $stockImg = "http://localhost/BLOG-PHP/public/img/upload/" . $filename;
            }
            if (!empty($_POST['title'] && !empty($_POST['chapo']) && !empty($_POST['content']) && !empty($_POST['altImage']))) {
                $idArticle = $_GET['id_article'];
                $article = $this->articleRepository->getArticle($idArticle);
                if (isset($stockImg)) {
                    $newImage = $stockImg;
                } else {
                    $newImage = $article->getImage();
                }
                $article = new Article([
                    "title" => $_POST['title'],
                    "chapo" => $_POST['chapo'],
                    "content" => $_POST['content'],
                    "date_modification" => $date,
                    "image" => $newImage,
                    "alt" => $_POST['altImage']
                ]);
                $this->articleRepository->changeArticle($idArticle, $article);
                $articlesPublish = $this->articleRepository->getArticlesPublishAdmin();
                $articlesNoPublish = $this->articleRepository->getArticlesNoPublishAdmin();
                echo $this->render('listArticles.html.twig', ["articlesPublish" => $articlesPublish, "articlesNoPublish" => $articlesNoPublish]);

            }
        }
    }

    public function deleteArticle():void
    {
        if (!empty($_GET['id_article'])) {
            $idArticle = $_GET['id_article'];
            $this->commentRepository->removeCom($idArticle);
            $this->articleRepository->removeArticle($idArticle);
            $articlesPublish = $this->articleRepository->getArticlesPublishAdmin();
            $articlesNoPublish = $this->articleRepository->getArticlesNoPublishAdmin();
            echo $this->render('listArticles.html.twig', ["articlesPublish" => $articlesPublish, "articlesNoPublish" => $articlesNoPublish]);
        } else {
            echo $this->render('error404.html.twig');
        }
    }


    public function createComment():void
    {
        if (isset($_POST['submitComment'])) {
            if (!empty($_POST['message'])) {
                $comment = new Comment([
                    "content" => $_POST['message'],
                    "id_user" => (int) $_SESSION['user']['idUser'],
                    "id_article" => (int) $_GET["id_article"]
                ]);

                $this->commentRepository->addComment($comment);
                header('location: http://localhost/BLOG-PHP/public/index.php?action=article&id_article=' . $_GET["id_article"]);

            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->render('createArticle.html.twig', ["error" => $error]);
            }
        }
    }
    public function listComments():void
    {
        $comments = $this->commentRepository->listComments();

        echo $this->render('listComments.html.twig', ["comments" => $comments]);
    }

    public function approveCom():void
    {
        $idCom = $_GET["id_comment"];
        $this->commentRepository->validCom($idCom);
        header('location: http://localhost/BLOG-PHP/public/index.php?action=listComments');
    }

    public function deleteCom():void
    {
        //
        $idCom = $_GET["id_comment"];
        $this->commentRepository->refuseCom($idCom);
        header('location: http://localhost/BLOG-PHP/public/index.php?action=listComments');

    }

}