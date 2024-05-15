<?php
class User {
    private int $id_comment;
    private string $content;
    private DateTime $date_publication;
    private DateTime $date_modification;
    private bool $delete;

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
    public function id_comment():int {
        return $this->id_comment;
    }
    public function content():string {
        return $this->content;
    }
    public function date_publication():DateTime {
        return $this->date_publication;
    }
    public function date_modification():DateTime {
        return $this->date_modification;
    }

    public function delete():bool {
        return $this->delete;
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

    public function setDelete(bool $delete) {
        $this->delete= $delete;
    }
}
