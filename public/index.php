<?php

$action = $_GET["action"] ?? "index";

switch ($action) {
	case "index":
        // $controller = new HomeController;
        // $controller->index();
        // break;
        include "./../src/views/portfolio.html";
    }

