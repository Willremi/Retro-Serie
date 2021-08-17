<?php

namespace App\Controllers;

use App\Core\Form;
use App\Core\OpenApi;

class SearchController extends Controller
{
    /**
     * Fonction pour appeler la recherche de séries
     *
     * @return void
     */
    public function tv()
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        // Créer un formulaire pour recherche puis filtrer les résultats avec name et nameOrigin
        // Condition date->null ou vide
        // $search = $api->getSearchTv('Superman');
        $search = null;
        if (Form::validate($_POST, ['searchTv'])) {
            $post = htmlspecialchars(trim($_POST['searchTv']));
            $motSearch = explode(' ', $post);
            $query = implode('-', $motSearch);
            $search = $api->getSearchTv($query);
        }

        $form = new Form;
        $form->debutForm($method = "post", $action = "", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('searchTv', "Recherche")
            ->ajoutInput('text', 'searchTv', [
                'class' => 'form-control',
                'id' => 'searchTv', 
                'placeholder' => 'Higlander, les incorruptibles, ...'
            ])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutBouton('Chercher', ['class' => 'btn btn-success'])
            ->finDiv()
            ->finForm();

        $popTv = $api->getPopularTv();

        $this->render('search/tv', ['formSearch' => $form->create(), 'search' => $search, 'popTv' => $popTv], 'series');
        // var_dump($popTv);
    }

    public function person($page = 1)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $search = null;

        if(Form::validate($_POST, ['searchPop'])) {
            $post = htmlspecialchars(trim($_POST['searchPop']));
            $motSearch = explode(' ', $post);
            $query = implode('+', $motSearch);
            $search = $api->getSearchPerson($query);
        }

        $form = new Form;

        $form->debutForm($method = "post", $action = "", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('searchPop', "Recherche")
            ->ajoutInput('text', 'searchPop', [
                'class' => 'form-control',
                'id' => 'searchPop', 
                'placeholder' => 'Veuillez mettre le nom ou prénom du people recherché'
            ])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutBouton('Chercher', ['class' => 'btn btn-success'])
            ->finDiv()
            ->finForm();

        $popCelebs = $api->getPopularPerson($page);

        $this->render('search/person', ['formSearch' => $form->create(), 'search' => $search, 'popCelebs' => $popCelebs], 'series');
        // var_dump($search);
        // var_dump($popCelebs);
    }
}
