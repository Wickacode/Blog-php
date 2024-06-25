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
            if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPass'])) {
                $hashedpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $user = new User([
                    "firstname" => $_POST['firstname'],
                    "lastname" => $_POST['lastname'],
                    "email" => $_POST['email'],
                    "pseudo" => $_POST['pseudo'],
                    "password" => $hashedpassword
                ]);

            } else {
                $error = "Tous les champs doivent être saisis";
                echo $this->twig->render('register.html.twig', ["error" => $error]);
            }
            $passwordLength = strlen($_POST['password']);
            if ($passwordLength >= 8) {
                if ($_POST['password'] == $_POST['confirmPass']) {
                    $repository = new UsersRepository();
                    $repository->addUser($user);
                    $validAdd = "Votre compte a bien été crée, vous pouvez maintenant vous connecter";
                } else {
                    $error = "Les mots de passe doivent être identiques.";
                    echo $this->twig->render('register.html.twig', ["error" => $error]);
                }
            } else {
                $error = "Le mot de passe doit contenir minimum 8 caractères.";
                echo $this->twig->render('register.html.twig', ["error" => $error]);
            }
        }
        if (isset($validAdd)) {
            echo $this->twig->render('login.html.twig', ["validAdd" => $validAdd]);
        } else {
            echo $this->twig->render('register.html.twig');
        }
    }
    public function login()
    {
        if (isset($_POST['submitLogin'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $repository = new UsersRepository();
                $user = $repository->getUserByEmail($_POST['email']);

                if (password_verify($_POST['password'], $user->getPassword())) {
                    $_SESSION['auth'] = true;
                    $_SESSION['userId'] = $user->getId_user();
                    $_SESSION['role'] = $user->getRole();
                    echo $this->twig->render('home.html.twig');
                } else {
                    $error = "Le mot de passe est incorrect";
                    echo $this->twig->render('login.html.twig', ["error" => $error]);
                }
            }
        }
        echo $this->twig->render('login.html.twig');
    }
}