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
            VALUES (:content, :date_publication, :date_modification, NULL, 0, :id_article, :id_user)';
    
            $query = $this->mysqlClient->prepare($sql);
            $query->bindValue('content',$comment->getContent(), PDO::PARAM_STR);
            $query->bindValue('date_publication',$comment->getDate_publication()->format('Y-m-d'), PDO::PARAM_STR);
            $query->bindValue('date_modification',$comment->getDate_modification()->format('Y-m-d'), PDO::PARAM_STR);
            $query->bindValue('id_user',$comment->getIdUser(), PDO::PARAM_INT);
            $query->bindValue('id_article',$comment->getIdArticle(), PDO::PARAM_INT);
            $query->execute();
            
        }
}
