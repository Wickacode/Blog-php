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
        $sql = 'INSERT INTO comment (content, statut, delete_comment, id_article, id_user)
            VALUES (:content, NULL, 0, :id_article, :id_user)';
    
            $query = $this->mysqlClient->prepare($sql);
            $query->bindValue('content',$comment->getContent(), PDO::PARAM_STR);
            $query->bindValue('id_user',$comment->getId_user(), PDO::PARAM_INT);
            $query->bindValue('id_article',$comment->getId_article(), PDO::PARAM_INT);
            $query->execute();
            
    }

    public function getComments($id) {
        $sql = "SELECT * FROM comment AS c,user AS u  WHERE c.id_user = u.id_user AND id_article = $id AND statut = 1";
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataComments = $query->fetchAll();
        return $dataComments;
    }

    public function listComments() {
        $sql = "SELECT * FROM comment WHERE statut IS NULL ";
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataComments = $query->fetchAll();
        $comments = [];
        foreach($dataComments as $comment) {
            $comments[] = new Comment($comment);
        } 
        return $comments;
    }
    public function approveComments() {

    }
}
