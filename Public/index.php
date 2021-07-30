<?php
use App\Autoloader;
use App\Core\Main;

// Définit une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

// Importe l'Autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// Importe les bibliothèques Composer
require_once ROOT.'/vendor/autoload.php';

// Instancie Main (le routeur)
$app = new Main;

// Démarre l'application
$app->start();
