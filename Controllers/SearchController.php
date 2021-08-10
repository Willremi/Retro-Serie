<?php
namespace App\Controllers;

use App\Core\OpenApi;

class SearchController extends Controller
{
    public function tv() {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');
        // Créer un formulaire pour recherche puis filtrer les résultats avec name et nameOrigin
        // Condition date->null ou vide
        $search = $api->getSearchTv('batman');

        $this->render('search/tv', ['search' => $search], 'series');
        var_dump($search);
    }
}