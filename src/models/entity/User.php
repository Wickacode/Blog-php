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
 
    public function id_user():int {
        return $this->id_user;
    }
    public function firstname():string {
        return $this->firstname;
    }
    public function lastname():string {
        return $this->lastname;
    }
    public function email():string {
        return $this->email;
    }
    public function pseudo():string {
        return $this->pseudo;
    }
    public function password():string {
        return $this->password;
    }

    public function role():bool {
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