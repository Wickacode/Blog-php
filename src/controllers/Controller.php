<?php
namespace Controllers;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller {
    private $loader;
    protected $twig;
    private $session;
    private $user;

    public function __construct(){
        //On paramètre le dossier contenant les templates
        $this->loader = new FilesystemLoader(ROOT .'\src\views');

        //On paramètre l'environnement twig
        $this->twig = new Environment($this->loader);
    }

    public function createSession(array $sessionDatas) {
        $this->session["user"] = [
            'sessionId' => session_id(),
            'idUser' => $sessionDatas['id_user'],
            'firstname' => $sessionDatas['firstname'],
            'lastname' => $sessionDatas['lastname'],
            'email' => $sessionDatas['login_user'],
            'pseudo' => $sessionDatas['email_user'],
            'password' => $sessionDatas['dateCreate_user'],
            'role' => $sessionDatas['role_user']
        ];
        $this->user = $this->session['user'];
        $_SESSION['user'] = $this->session['user'];
        return $_SESSION['user'];
    }
}