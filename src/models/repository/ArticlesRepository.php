<?php
namespace Models\Repository;

use Models\Entity\Article;
use PDO;

class ArticlesRepository extends Repository
{
    // Récupère tous les articles publiés
    public function getArticles(): array
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
    // Récupère un article spécifique basé sur son identifiant $id
    public function getArticle(int $id): ?Article
    {
        $request = $this->mysqlClient->query("SELECT * FROM article WHERE id_article = '$id' ");
        $result = ($request->fetch());
        if ($result) {
            $article = new Article($result);
            return $article;
        }

        return null;
    }
    //  Ajoute un nouvel article dans la base de données
    public function addArticle(Article $article): void
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

    //Modifie un article existant identifié par $id_article
    public function changeArticle(int $id_article, Article $article): void
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
        $query->execute();
    }
    //Récupère tous les articles publiés (delete_article = 1) pour l'administration
    public function getArticlesPublishAdmin(): array
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
    //Publie un article en définissant delete_article à 1 pour l'article identifié par $idArticle
    public function publishArticleSQL(int $idArticle): void
    {
        $sql = 'UPDATE article SET delete_article = 1 WHERE id_article = :id_article';
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_article', $idArticle, PDO::PARAM_INT);
        $query->execute();
    }
    //Récupère tous les articles non publiés (delete_article = 0) pour l'administration
    public function getArticlesNoPublishAdmin(): array
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
    //Supprime définitivement un article de la base de données basé sur son identifiant $idArticle
    public function removeArticle(int $idArticle): void
    {
        $sql = "DELETE FROM article WHERE id_article = :id_article";
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_article', $idArticle, PDO::PARAM_INT);
        $query->execute();

    }
}