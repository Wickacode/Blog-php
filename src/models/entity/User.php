<?php
namespace Models\Entity;

class User
{
    private int $id_user;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $pseudo;
    private string $password;
    private bool $role;

    //L'hydratation 
    //Méthode magique 
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPseudo(): string
    {
        return $this->pseudo;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): bool
    {
        return $this->role;
    }

    //Setter
    //Assigne la valeur à l'attribut
    public function setIdUser(int $id): void
    {
        $this->id_user = $id;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setRole(bool $role): void
    {
        $this->role = $role;
    }
}
