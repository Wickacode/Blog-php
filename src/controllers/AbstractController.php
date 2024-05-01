<?php 

namespace App\src\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController {

    const ADMIN = 'Administrateur';

    const USER = 'Utilisateur';

    private $twig;

/**
     * Afficher une vue avec la méthode render
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function render(string $view, array $data = [])
    {
        //un chargement de fichiers est configuré pour le moteur de template Twig. Il utilise le système de fichiers pour charger les fichiers de template à partir du répertoire src/views.
        $loader = new FilesystemLoader('src/views');
        //une instance de la classe Environment de Twig est créée, en passant le chargeur de fichiers et quelques options supplémentaires, telles que la désactivation du cache
        $this->twig = new Environment(
            $loader, [
            'cache' => false, // __DIR__ . /tmp',
            'debug' => true,] 
        );
        
        define('view', $view);
        
            if( file_exists('src/views/front/'.$view.'.twig'))
            {
                echo $this->twig->render('front/'. $view . '.twig', $data);
            }
            else
            {
                echo $this->twig->render('back/'. $view . '.twig', $data);
            }
       
    }
}