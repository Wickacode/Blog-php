<?php

namespace Controllers;

class ContactController extends Controller
{
    public function pageContact(): void
    {
        echo $this->render('contact.html.twig');
    }

    public function contact()
    {
        if (isset($_POST['submitContact'])) {
            if (!empty($_POST['email']) && !empty($_POST['message']) && !empty($_POST['objet'])) {
                $dest = "jessica.garrido.di@gmail.com";
                $message = $_POST['message'];
                $email = $_POST['email'];
                $objet = $_POST['objet'];
                $entetes = "From:" . $email;
                $entetes .= "Cc:" . $dest;
                $entetes .= "Content-Type: text/html; charset=iso-8859-1";

                if (mail($dest, $objet, $message, $entetes)) {                    $validInbox = "Mail envoyé avec succès.";
                    echo $this->render('contact.html.twig', ["validInbox" => $validInbox]);
                } else {
                    $error = "Un problème est survenu.";
                    echo $this->render('contact.html.twig', ["error" => $error]);
                }

            }
        }
    }
}
