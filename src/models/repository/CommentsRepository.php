<?php 
namespace Models\Repository;
use Models\Entity\Comment;
use PDO;

class CommentsRepository extends Repository
{
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
        $comments = [];
        foreach($dataComments as $comment) {
            $comments[]= new Comment($comment);
        }
        return $comments;
    }

    public function listComments() {
        $sql = "SELECT c.content, u.pseudo, a.title, c.id_comment FROM comment AS c,user AS u, article AS a WHERE a.id_article = c.id_article AND c.id_user = u.id_user AND statut IS NULL ";
        $query = $this->mysqlClient->prepare($sql);
        $query->execute();
        $dataComments = $query->fetchAll();
        $comments = [];
        foreach($dataComments as $comment) {
            $comments[]= new Comment($comment);
        }
        return $comments;
    }
    public function validCom($idCom) {
        $sql = 'UPDATE comment SET statut = 1 WHERE id_comment = :id_comment';
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_comment', $idCom, PDO::PARAM_INT);
        $data = $query->execute(); 
        return $data;
    }

    public function refuseCom($idCom) {
        $sql = 'UPDATE comment SET statut = 0 WHERE id_comment = :id_comment';
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_comment', $idCom, PDO::PARAM_INT);
        $data = $query->execute();
        return $data;
    }

    public function removeCom($idArticle)
    {
        $sql = "DELETE FROM comment WHERE id_article = :id_article";
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue(':id_article', $idArticle, PDO::PARAM_INT);
        $data = $query->execute();
        return $data;
        
    }
}
