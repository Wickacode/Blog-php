<?php
namespace Models\Entity;
use Utils\StringConverter;

class Comment
{
    use StringConverter;
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
            $method = "set" . ucfirst($this->camelise($key));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    //Getter
    public function getIdComment(): int
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

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getIdArticle(): int
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
    public function setIdComment(int $id_comment): void
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

    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function setIdArticle(int $id_article): void
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
