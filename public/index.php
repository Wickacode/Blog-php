<?php
require "../vendor/autoload.php";
use Controllers\ArticlesController;
use Controllers\ContactController;
use Controllers\HomeController;
use Controllers\AuthController;


//Définition d'une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

$action = $_GET["action"] ?? "index";

switch ($action) {
    case "index":

        $controller = new HomeController();
        $controller->index();
        break;

    case "articles":
        // include "./../src/views/front/portfolio.html";
        $controller = new ArticlesController();
        $controller->listArticles();
        break;

    case "single":
        include "./../src/views/front/single.html";
        break;

    case "contact":
        $controller = new ContactController();
        $controller->contact();
        break;

    case "inscription":
        $controller = new AuthController();
        $controller->register();
        break;

    case "connexion":
        $controller = new AuthController();
        $controller->login();
        break;

}

