<?php
namespace App\Controllers;

use App\Core\Form;
use App\Core\OpenApi;

class SearchController extends Controller
{
    public function tv() {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');
        
        // Créer un formulaire pour recherche puis filtrer les résultats avec name et nameOrigin
        // Condition date->null ou vide
        // $search = $api->getSearchTv('Superman');
        $search = "";
        if(Form::validate($_POST, ['searchTv'])) {
            $post = htmlspecialchars(trim($_POST['searchTv']));
            $motSearch = explode(' ', $post);
            $query= implode('-', $motSearch);
            $search = $api->getSearchTv($query);
        }

        $form = new Form;

        $form->debutForm($method="post", $action="", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('searchTv', "Recherche")
            ->ajoutInput('text', 'searchTv', ['class' => 'form-control', 'id' => 'searchTv'])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutBouton('Chercher', ['class' => 'btn btn-success'])
            ->finDiv()
            ->finForm();

        $this->render('search/tv', ['formSearch'=>$form->create(), 'search' => $search], 'series');
        var_dump($search);
    }
}