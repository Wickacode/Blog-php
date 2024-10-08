<?php
namespace Models\Entity;

use DateTime;
use Utils\StringConverter;

class Article
{ 
    use StringConverter;
    private int $id_article;
    private string $title;
    private string $chapo;
    private string $content;
    private DateTime $date_publication;
    private DateTime $date_modification;
    private string $image;
    private bool $delete_article;
    private string $alt;

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
    public function getIdArticle(): int
    {
        return $this->id_article;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getChapo(): string
    {
        return $this->chapo;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getDatePublication(): DateTime
    {
        return $this->date_publication;
    }
    public function getDateModification(): DateTime
    {
        return $this->date_modification;
    }
    public function getImage(): string
    {
        return $this->image;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }


    public function getDelete(): bool
    {
        return $this->delete_article;
    }

    //Setter
    //Assigne la valeur à l'attribut
    public function setIdArticle(int $id): void
    {
        $this->id_article = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setChapo(string $chapo): void
    {
        $this->chapo = $chapo;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setDatePublication(string $date_publication): void
    {
        $this->date_publication = DateTime::createFromFormat('Y-m-d', $date_publication);
    }

    public function setDateModification(string $date_modification): void
    {
        $this->date_modification = DateTime::createFromFormat('Y-m-d', $date_modification);
    }
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }
    public function setDelete(bool $delete_article): void
    {
        $this->delete_article = $delete_article;
    }
}
