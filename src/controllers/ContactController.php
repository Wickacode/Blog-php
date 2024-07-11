<?php

namespace Controllers;

class ContactController extends Controller
{
    public function contact()
    {
        echo $this->render('contact.html.twig');
    }
} 