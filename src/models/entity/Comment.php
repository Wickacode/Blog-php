<?php
namespace Models\Entity;
use DateTime;
class Comment {
    private int $id_comment;
    private string $content;
    private DateTime $date_publication;
    private DateTime $date_modification;
    private bool $delete_comment;

    private int $id_article;
    private int $id_user;

    //L'hydratation 
    //Méthode magique 
    public function __construct(array $data) {
        foreach($data as $key=> $value ) {
            $method= "set" .ucfirst($key);
            if (method_exists($this,$method)) {
                $this->$method($value);
            }
        }
    }
 

    //Getter
    public function getId_comment():int {
        return $this->id_comment;
    }
    public function getContent():string {
        return $this->content;
    }
    public function getDate_publication():DateTime {
        return $this->date_publication;
    }
    public function getDate_modification():DateTime {
        return $this->date_modification;
    }

    public function getDelete():bool {
        return $this->delete_comment;
    }

    public function getIdUser():int {
        return $this->id_user;
    }

    public function getIdArticle():int {
        return $this->id_comment;
    }

    //Setter
    //Assigne la valeur à l'attribut
    public function setId_comment(int $id_comment) {
        $this->id_comment= $id_comment;
    }

    public function setContent(string $content) {
        $this->content= $content;
    }

    public function setDate_publication(DateTime $date_publication) {
        $this->date_publication= $date_publication;
    }

    public function setDate_modification(DateTime $date_modification ) {
        $this->date_modification= $date_modification ;
    }

    public function setDelete(bool $delete_comment) {
        $this->delete_comment= $delete_comment;
    }

    public function setIdUser(int $id_user) {
        $this->id_user= $id_user;
    }

    public function setIdArticle(int $id_article) {
        $this->id_article = $id_article;
    }
}
