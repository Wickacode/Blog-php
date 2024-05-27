<?php

namespace Controllers;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller {
    private $loader;
    protected $twig;

    public function __construct(){
        //On paramètre le dossier contenant les templates
        $this->loader = new FilesystemLoader(ROOT .'\src\views');

        //On paramètre l'environnement twig
        $this->twig = new Environment($this->loader);
    }
}