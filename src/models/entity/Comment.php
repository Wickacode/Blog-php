<?php
namespace Models\Entity;
class Comment
{
    private int $id_comment;
    private string $content;
    private bool $delete_comment;
    private int $id_article;
    private int $id_user;
    private string $title;
    private string $pseudo;

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


    //Getter
    public function getId_comment(): int
    {
        return $this->id_comment;
    }
    public function getContent(): string
    {
        return $this->content;
    }

    public function getDelete(): bool
    {
        return $this->delete_comment;
    }

    public function getId_user(): int
    {
        return $this->id_user;
    }

    public function getId_article(): int
    {
        return $this->id_article;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    //Setter
    //Assigne la valeur à l'attribut
    public function setId_comment(int $id_comment): void
    {
        $this->id_comment = $id_comment;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setDelete(bool $delete_comment): void
    {
        $this->delete_comment = $delete_comment;
    }

    public function setId_user(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function setId_article(int $id_article): void
    {
        $this->id_article = $id_article;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }
}