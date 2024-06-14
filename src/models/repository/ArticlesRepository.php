<?php
namespace Models\Repository;
use Models\Entity\Article;
use PDO;

class ArticlesRepository
{
    private PDO $mysqlClient;
    public function __construct() 
    {
        $this->mysqlClient = new PDO('mysql:host=localhost;dbname=blog-php;charset=utf8', 'root', '');
    }

    public function getArticles()
    {
        $request = $this->mysqlClient->query("SELECT * FROM article");
        $result = ($request->fetchAll());
        $tabArticles = [];
        foreach($result as $article) {
            $tabArticles[]= new Article($article);
        } return $tabArticles;
    }

    public function getArticle($id)
    {
        $request = $this->mysqlClient->query("SELECT * FROM article WHERE id_article = '$id' ");
        $result = ($request->fetch());
        $article = new Article($result);
        return $article;
    }

    public function addArticle(Article $article){
        $sql = 'INSERT INTO article (title, chapo, content, /*date_publication, date_modification,*/ image, alt)
            VALUES (:title, :chapo, :content, /*:date_publication, :date_modification,*/ :image, :alt)';
    
            $query = $this->mysqlClient->prepare($sql);
            $query->bindValue('title',$article->getTitle(), PDO::PARAM_STR);
            $query->bindValue('chapo',$article->getChapo(), PDO::PARAM_STR);
            $query->bindValue('content',$article->getContent(), PDO::PARAM_STR);
            // $query->bindValue('date_publication',$article->getDate_publication(), PDO::PARAM_STR);
            // $query->bindValue('date_modification',$article->getDate_modification(), PDO::PARAM_STR);
            $query->bindValue('image',$article->getImage(), PDO::PARAM_STR);
            $query->bindValue('alt',$article->getAlt(), PDO::PARAM_STR);
            $query->execute();
        }
} 