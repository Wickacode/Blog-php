<?php
namespace Models\Repository;
use Models\Entity\Article;
use PDO;

class ArticlesRepository
{
    private PDO $mysqlClient;
    public function __construct() 
    {
        $this->mysqlClient = new PDO('mysql:host=localhost;dbname=blog-php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    }

    public function getArticles(){
        $sql = 'SELECT * FROM article';
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataArticles = $query->fetchAll();
        $articles = [];
        foreach($dataArticles as $article) {
            $articles[] = new Article($article);
        } 
        return $articles;
    }

    // public function getArticle($id){
    //     $sql = 'SELECT * FROM article where id_article = :id_article';
    //     $query = $this->mysqlClient->prepare($sql);
    //     $query->bindValue(':id_article', $id, PDO::PARAM_INT);
    //     $query->execute();
    //     $dataArticle = $query->fetchAll();
    //     return $dataArticle;
    // }

    public function getArticle($id)
    {
        $request = $this->mysqlClient->query("SELECT * FROM article WHERE id_article = '$id' ");
        $result = ($request->fetch());
        $article = new Article($result);
        return $article;
    }

    public function addArticle(Article $article){
        $sql = 'INSERT INTO article (title, chapo, content, date_publication, date_modification, image, alt, id_user)
            VALUES (:title, :chapo, :content, :date_publication, :date_modification, :image, :alt, :id_user)';
    
            $query = $this->mysqlClient->prepare($sql);
            $query->bindValue('title',$article->getTitle(), PDO::PARAM_STR);
            $query->bindValue('chapo',$article->getChapo(), PDO::PARAM_STR);
            $query->bindValue('content',$article->getContent(), PDO::PARAM_STR);
            $query->bindValue('date_publication',$article->getDate_publication()->format('Y-m-d'), PDO::PARAM_STR);
            $query->bindValue('date_modification',$article->getDate_modification()->format('Y-m-d'), PDO::PARAM_STR);
            $query->bindValue('image',$article->getImage(), PDO::PARAM_STR);
            $query->bindValue('alt',$article->getAlt(), PDO::PARAM_STR);
            $query->bindValue('id_user', 1,PDO::PARAM_INT);
            $query->execute();
            
        }
        
} 