<?php 
namespace Controllers;

class AdminController extends Controller
{
    public function administration()
    {
        echo $this->render('administration.html.twig');
    }
} 