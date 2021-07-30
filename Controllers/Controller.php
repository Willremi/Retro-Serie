<?php
namespace App\Controllers;

abstract class Controller
{
    /**
     * Afficher la vue
     *
     * @param string $file
     * @param array $data
     * @param string $template
     * @return void
     */
    public function render(string $file, array $data = [], string $template = 'default')
    {
        // Récupére les données et les extrait sous forme de variables
        extract($data);

        // Démarrage le buffer de sortie
        ob_start();
        
        // Crée le chemin et inclut le fichier de vue
        require_once ROOT.'/Views/'.$file.'.php';

        // Stocke le contenu dans $content
        $content = ob_get_clean();

        // Fabrique le "template"
        require_once ROOT.'/Views/'.$template.'.php';
    }
}