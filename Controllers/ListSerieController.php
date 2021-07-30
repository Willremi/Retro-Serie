<?php
namespace App\Controllers;

use App\Core\OpenApi;

class ListSerieController extends Controller
{
    public function index()
    {
        // Appel de l'API
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');
        
        // Génére la vue
        $this->render('series/index', compact('api'), 'series');
        
    }
}