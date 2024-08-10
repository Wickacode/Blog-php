<?php
namespace Models\Repository;

use Models\Entity\Article;
use PDO;

class ArticlesRepository
{
    private PDO $mysqlClient;
    public function __construct()
    {
        $this->mysqlClient = new PDO('mysql:host=localhost;dbname=blog-php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public function getArticles()
    {
        $sql = 'SELECT * FROM article WHERE delete_article=1';
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataArticles = $query->fetchAll();
        $articles = [];
        foreach ($dataArticles as $article) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    public function getArticle($id)
    {
        $request = $this->mysqlClient->query("SELECT * FROM article WHERE id_article = '$id' ");
        $result = ($request->fetch());
        if($result) {
               $article = new Article($result);
        return $article;
        }

        return null;
     
    }

    public function addArticle(Article $article)
    {
        $sql = 'INSERT INTO article (title, chapo, content, date_publication, date_modification, image, delete_article, alt, id_user)
            VALUES (:title, :chapo, :content, :date_publication, :date_modification, :image, 0,:alt, :id_user)';

        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue('title', $article->getTitle(), PDO::PARAM_STR);
        $query->bindValue('chapo', $article->getChapo(), PDO::PARAM_STR);
        $query->bindValue('content', $article->getContent(), PDO::PARAM_STR);
        $query->bindValue('date_publication', $article->getDate_publication()->format('Y-m-d'), PDO::PARAM_STR);
        $query->bindValue('date_modification', $article->getDate_modification()->format('Y-m-d'), PDO::PARAM_STR);
        $query->bindValue('image', $article->getImage(), PDO::PARAM_STR);
        $query->bindValue('alt', $article->getAlt(), PDO::PARAM_STR);
        $query->bindValue('id_user', 1, PDO::PARAM_INT);
        $query->execute();

    }

    public function changeArticle($id_article, $article)
    {
        $sql = 'UPDATE article SET title = :title, chapo = :chapo, content = :content, date_modification = :date_modification, image = :image, delete_article=0,alt = :alt WHERE id_article = :id_article';
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue('title', $article->getTitle(), PDO::PARAM_STR);
        $query->bindValue('chapo', $article->getChapo(), PDO::PARAM_STR);
        $query->bindValue('content', $article->getContent(), PDO::PARAM_STR);
        $query->bindValue('date_modification', $article->getDate_modification()->format('Y-m-d'), PDO::PARAM_STR);
        $query->bindValue('image', $article->getImage(), PDO::PARAM_STR);
        $query->bindValue('alt', $article->getAlt(), PDO::PARAM_STR);
        $query->bindValue('id_article', $id_article, PDO::PARAM_INT);
        $data = $query->execute();
        return $data;
    }

    public function getArticlesPublishAdmin()
    {
        $sql = 'SELECT * FROM article WHERE delete_article = 1';
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataArticles = $query->fetchAll();
        $articles = [];
        foreach ($dataArticles as $article) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    public function publishArticleSQL($idArticle)
    {
        $sql = 'UPDATE article SET delete_article = 1 WHERE id_article = :id_article';
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_article', $idArticle, PDO::PARAM_INT);
        $data = $query->execute(); 
        return $data;
    }

    public function getArticlesNoPublishAdmin()
    {
        $sql = 'SELECT * FROM article WHERE delete_article = 0';
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataArticles = $query->fetchAll();
        $articles = [];
        foreach ($dataArticles as $article) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    public function removeArticle($idArticle)
    {
        $sql = "DELETE FROM article WHERE id_article = :id_article";
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_article', $idArticle, PDO::PARAM_INT);
        $data = $query->execute();
        return $data;
        
    }
}