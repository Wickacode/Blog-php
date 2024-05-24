<?php
require "../vendor/autoload.php";
use Controllers\ArticlesController;

$action = $_GET["action"] ?? "index";

switch ($action) {
    case "index":

        include "./../src/views/index.html";
        break;

    case "articles":
        // include "./../src/views/portfolio.html";
        $controller = new ArticlesController();
        $controller->listArticles();
        break;

    case "single":
        include "./../src/views/single.html";
        break;

}

