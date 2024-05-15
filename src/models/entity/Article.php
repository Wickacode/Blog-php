<?php

class Article
{
    private int $id_article;
    private string $title;
    private string $chapo;
    private string $content;
    private DateTime $date_publication;
    private DateTime $date_modification;
    private string $image;
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
    public function id_user(): int
    {
        return $this->id_article;
    }
    public function title(): string
    {
        return $this->title;
    }
    public function chapo(): string
    {
        return $this->chapo;
    }
    public function content(): string
    {
        return $this->content;
    }
    public function datePublication(): DateTime
    {
        return $this->date_publication;
    }
    public function dateModification(): DateTime
    {
        return $this->date_modification;
    }
    public function image(): string
    {
        return $this->image;
    }
    public function delete(): bool
    {
        return $this->delete;
    }

    //Setter
    //Assigne la valeur à l'attribut
    public function setId_article(int $id)
    {
        $this->id_article = $id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setChapo(string $chapo)
    {
        $this->chapo = $chapo;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setDate_publication(DateTime $date_publication)
    {
        $this->date_publication = $date_publication;
    }

    public function setDate_modification(DateTime $date_modification)
    {
        $this->date_modification = $date_modification;
    }
    public function setImage(string $image)
    {
        $this->image = $image;
    }
    public function setDelete(bool $delete)
    {
        $this->delete = $delete;
    }

}