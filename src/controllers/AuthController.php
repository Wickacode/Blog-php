<?php

namespace Controllers;

use Models\Entity\User;
use Models\Repository\UsersRepository;

class AuthController extends Controller
{
    private UsersRepository $usersRepository;
    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
    }

    public function registerView():void
    {
        echo $this->render('register.html.twig');

    }
    public function register():void
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
                echo $this->render('register.html.twig', ["error" => $error]);
            }
            $verifMailPseudo = $this->usersRepository->countMailPseudo($user);
            $passwordLength = strlen($_POST['password']);
            if ($verifMailPseudo['nbMailPseudo'] === '0') {
                if ($passwordLength >= 8) {
                    if ($_POST['password'] == $_POST['confirmPass']) {
                        $this->usersRepository->addUser($user);
                        $validAdd = "Votre compte a bien été crée, vous pouvez maintenant vous connecter";
                    } else {
                        $error = "Les mots de passe doivent être identiques.";
                        echo $this->render('register.html.twig', ["error" => $error]);
                    }
                } else {
                    $error = "Le mot de passe doit contenir minimum 8 caractères.";
                    echo $this->render('register.html.twig', ["error" => $error]);
                }
            } else {
                $error = "L'adresse email ou le pseudo sont déjà pris";
                echo $this->render('register.html.twig', ["error" => $error]);
            }
        }
        if (isset($validAdd)) {
            echo $this->render('login.html.twig', ["validAdd" => $validAdd]);
        }

    }
    public function loginUser():void
    {
        if (isset($_POST['submitLogin'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $user = $this->usersRepository->getUserByEmail($_POST['email']);

                if (isset($user)) {
                    $dataUser = $this->usersRepository->readUser($user);

                    if (password_verify($_POST['password'], $user->getPassword())) {
                        $this->createSession($dataUser);
                        echo $this->render('home.html.twig');
                    } else {
                        $error = "Le mot de passe est incorrect";
                        echo $this->render('login.html.twig', ["error" => $error]);
                    }

                } else {
                    $error = "Le mail est incorrect";
                    echo $this->render('login.html.twig', ["error" => $error]);
                }
            }
        }
    }

    public function login():void
    {
        echo $this->render('login.html.twig');
    }

    public function logout():void
    {
        unset($_SESSION['user']);
        echo $this->render('home.html.twig');
    }
}