<?php
namespace Models\Repository;

class ArticlesRepository
{
    public function getArticles()
    {
        $mysqlClient = new \PDO('mysql:host=localhost;dbname=blog-php;charset=utf8', 'root', '');
        $request = $mysqlClient->query("SELECT * FROM article");

        var_dump($request->fetchAll());
    }
}