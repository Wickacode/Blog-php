<?php
require "../vendor/autoload.php";
use Controllers\ArticlesController;
use Controllers\ContactController;
use Controllers\HomeController;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\UsersController;
use Middlewares\Admin;
use Middlewares\Auth;

//Activation de la super globale
session_start();


//Définition d'une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

$action = $_GET["action"] ?? "index";

switch ($action) {
    case "index":
        $controller = new HomeController();
        $controller->index();
        break;

    case "articles":
        $controller = new ArticlesController();
        $controller->listArticles();
        break;

    case "article":
        $controller = new ArticlesController();
        $controller->Article();
        break;

    case "createArticle":
        new Admin();
        $controller = new ArticlesController();
        $controller->createArticle();
        break;

    case "getListArticles":
        new Admin();
        $controller = new ArticlesController();
        $controller->getListArticles();
        break;

    case "formUpdateArticle":
        new Admin();
        $controller = new ArticlesController();
        $controller->formUpdateArticle();
        break;

    case "updateArticle":
        new Admin();
        $controller = new ArticlesController();
        $controller->updateArticle();
        break;

    case "publishArticle":
        new Admin();
        $controller = new ArticlesController();
        $controller->publishAdminArticle();
        break;

    case "deleteArticle":
        new Admin();
        $controller = new ArticlesController();
        $controller->deleteArticle();
        break;

    case "createComment":
        new Auth();
        $controller = new ArticlesController();
        $controller->createComment();
        break;

    case "listComments":
        new Admin();
        $controller = new ArticlesController();
        $controller->listComments();
        break;

    case "approveCom":
        new Admin();
        $controller = new ArticlesController();
        $controller->approveCom();
        break;

    case "deleteCom":
        new Admin();
        $controller = new ArticlesController();
        $controller->deleteCom();
        break;

    case "contact":
        $controller = new ContactController();
        $controller->contact();
        break;

    case "register":
        $controller = new AuthController();
        $controller->register();
        break;

    case "registerView":
        $controller = new AuthController();
        $controller->registerView();
        break;

    case "loginUser":
        $controller = new AuthController();
        $controller->loginUser();
        break;

    case "login":
        $controller = new AuthController();
        $controller->login();
        break;
    case "logout":
        $controller = new AuthController();
        $controller->logout();
        break;

    case "administration":
        new Admin();
        $controller = new AdminController();
        $controller->administration();
        break;

    case "userManagement":
        new Admin();
        $controller = new UsersController();
        $controller->userManagement();
        break;

}

