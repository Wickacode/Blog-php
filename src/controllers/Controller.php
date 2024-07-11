<?php
namespace Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private $loader;
    protected $twig;
    private $session;
    private $user;

    public function __construct()
    {
        // //On paramètre le dossier contenant les templates
        // $this->loader = new FilesystemLoader(ROOT .'\src\views');

        // //On paramètre l'environnement twig
        // $this->twig = new Environment($this->loader);
        // $this->twig->addGlobal("session", $_SESSION);
    }
    public function render(string $view, array $data = [])
    {
        $loader = new FilesystemLoader(ROOT . '\src\views');
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false, // DIR . /tmp',
                'debug' => true,
            ]
        );
        $this->session = filter_var_array($_SESSION);
        if (isset($this->session['user'])) {
            $this->user = $this->session['user'];
        }
        if (isset($this->user)) {
            $this->twig->addGlobal("session", $this->user);
        }
        //define the constant to recover the good css file
        define('view', $view);

        if (file_exists(ROOT ."/src/views/front/" . $view)) {
            echo $this->twig->render('front/' . $view, $data);
        } else {
            echo $this->twig->render('back/' . $view, $data);
        }
        // echo $this->twig->render($view, $data);

    }

    public function createSession(array $sessionDatas)
    {
        $this->session["user"] = [
            'sessionId' => session_id(),
            'idUser' => $sessionDatas['id_user'],
            'firstname' => $sessionDatas['firstname'],
            'lastname' => $sessionDatas['lastname'],
            'pseudo' => $sessionDatas['pseudo'],
            'email' => $sessionDatas['email'],
            'password' => $sessionDatas['password'],
            'role' => $sessionDatas['role']
        ];
        $this->user = $this->session['user'];
        $_SESSION['user'] = $this->session['user'];
        return $_SESSION['user'];
    }
}