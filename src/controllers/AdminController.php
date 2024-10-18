<?php
namespace Controllers;

class AdminController extends Controller
{
    public function administration(): void
    {
        $this->render('administration.html.twig');
    }
}
