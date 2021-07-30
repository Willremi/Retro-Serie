<?php
namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__, 'autoload'
        ]);
    }

    static function autoload($class)
    {
        // On récupère dans $class la totalité du namespace de la classe concernée
        $class = str_replace(__NAMESPACE__.'\\', '', $class);

        // Remplace les \ par des /
        $class = str_replace('\\', '/', $class);

        $file = __DIR__.'/'.$class.'.php';

        // Vérifie si le fichier existe
        if(file_exists($file)) {
            require_once $file;
        }
    }
}
