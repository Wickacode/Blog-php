<?php 
namespace Models\Entity;

class User {
    private int $id_user;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $pseudo;
    private string $password;
    private bool $role;

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
 
    public function getId_user():int {
        return $this->id_user;
    }
    public function getFirstname():string {
        return $this->firstname;
    }
    public function getLastname():string {
        return $this->lastname;
    }
    public function getEmail():string {
        return $this->email;
    }
    public function getPseudo():string {
        return $this->pseudo;
    }
    public function getPassword():string {
        return $this->password;
    }

    public function getRole():bool {
        return $this->role;
    }

    //Setter
    //Assigne la valeur à l'attribut
    public function setId_user(int $id) {
        $this->id_user= $id;
    }

    public function setFirstname(string $firstname) {
        $this->firstname= $firstname;
    }

    public function setLastname(string $lastname) {
        $this->lastname= $lastname;
    }

    public function setEmail(string $email) {
        $this->email= $email;
    }

    public function setPseudo(string $pseudo) {
        $this->pseudo= $pseudo;
    }

    public function setPassword(string $password) {
        $this->password= $password;
    }
    public function setRole(bool $role) {
        $this->role= $role;
    }
}