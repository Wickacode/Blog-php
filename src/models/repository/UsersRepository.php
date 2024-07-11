<?php
namespace Models\Repository;
use Models\Entity\User;
use PDO;

class UsersRepository
{
    private PDO $mysqlClient;
    public function __construct() 
    {
        $this->mysqlClient = new PDO('mysql:host=localhost;dbname=blog-php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    }

    public function addUser($user) {
        $sql = 'INSERT INTO user (firstname, lastname, email, pseudo, password , role )
        VALUES (:firstname, :lastname, :email, :pseudo, :password , 0)';

        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue('firstname',$user->getFirstname(), PDO::PARAM_STR);
        $query->bindValue('lastname',$user->getLastname(), PDO::PARAM_STR);
        $query->bindValue('email',$user->getEmail(), PDO::PARAM_STR);
        $query->bindValue('pseudo',$user->getPseudo(), PDO::PARAM_STR);
        $query->bindValue('password',$user->getPassword(), PDO::PARAM_STR);
        $query->execute();
        
    }

    public function getUserByEmail($email){
        $query = $this->mysqlClient->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindValue('email', $email, PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
        return new User($data);
    }

    public function readUser($user) {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $query = $this->mysqlClient->prepare($sql);
        $query->bindValue('email',$user->getEmail(), PDO::PARAM_STR);
        $query->execute();
        $dataUser = $query->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }
}

?>