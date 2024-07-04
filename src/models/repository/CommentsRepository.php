<?php 
namespace Models\Repository;
use Models\Entity\Comment;
use PDO;

class CommentsRepository
{
    private PDO $mysqlClient;
    public function __construct() 
    {
        $this->mysqlClient = new PDO('mysql:host=localhost;dbname=blog-php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    }

    public function addComment(Comment $comment){
        $sql = 'INSERT INTO comment (content, date_publication, date_modification, statut, delete_comment, id_article, id_user)
            VALUES (:content, NOW(), NOW(), NULL, 0, :id_article, :id_user)';
    
            $query = $this->mysqlClient->prepare($sql);
            $query->bindValue('content',$comment->getContent(), PDO::PARAM_STR);
            $query->bindValue('id_user',$comment->getId_user(), PDO::PARAM_INT);
            $query->bindValue('id_article',$comment->getId_article(), PDO::PARAM_INT);
            $query->execute();
            
        }
}
