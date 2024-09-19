<?php
namespace Controllers;

use Models\Entity\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private $loader;
    protected $twig;
    private $session;
    private $user;

    public function render(string $view, array $data = []):void
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

        define('view', $view);

        if (file_exists(ROOT . "/src/views/front/" . $view)) {
            echo $this->twig->render('front/' . $view, $data);
        } else {
            echo $this->twig->render('back/' . $view, $data);
        }
    }

    public function createSession(User $user):array
    {
        $this->session["user"] = [
            'idUser' => $user->getIdUser(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];
        $this->user = $this->session['user'];
        $_SESSION['user'] = $this->session['user'];
        return $_SESSION['user'];
    }
}
