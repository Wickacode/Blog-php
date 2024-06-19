<?php

namespace Controllers;
use Models\Entity\User;
use Models\Repository\UsersRepository;

class AuthController extends Controller
{
    public function register()
    {
        //Gestion de la récupération et de la sauvegarde des données 
        if (isset($_POST['submitRegister'])) {
            if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['pseudo']) &&!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPass'])) {
                $hashedpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $user = new User([
                    "firstname" => $_POST['firstname'],
                    "lastname" => $_POST['lastname'],
                    "email" => $_POST['email'],
                    "pseudo" => $_POST['pseudo'],
                    "password" => $hashedpassword
                ]);
                $validAdd= "Votre compte a bien été crée";
            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->twig->render('register.html.twig', ["error" => $error]);
            }
            if($_POST['password'] == $_POST['confirmPass']) {
                $repository = new UsersRepository();
                $repository->addUser($user);
            }
        } 
        // if(isset($validAdd)) {
        //     echo $this->twig->render('register.html.twig',["validAdd" => $validAdd]);
        // } else {
            echo $this->twig->render('register.html.twig');
        // }    
        }
    public function login()
    {
        echo $this->twig->render('login.html.twig');
    }

} 