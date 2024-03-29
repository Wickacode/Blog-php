<?php 
use Controllers\HomeController;

$action = $_GET["action"];
switch ($action) {
	case "index":
        $controller = new HomeController;
        $controller->index();
        break;
    }