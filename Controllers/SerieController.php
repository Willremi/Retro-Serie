<?php
namespace App\Controllers;

use App\Core\Form;
use App\Core\OpenApi;

class SerieController extends Controller
{
    public function detail(string $id)
    {
        // Traitement avec l'API
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $serie = $api->getSerie($id);
        $credits = $api->getCredits($id);

        // Traitement avec Commentaire
        $commentaire = '';
        $form = new Form;

        $form->debutForm($methode = "post", $action = "", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('commentaire', 'Rédiger un commentaire')
            ->ajoutTextarea('commentaire', $commentaire, ['id' => 'commentaire', 'class' => 'form-control'])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutBouton('Envoyer', ['class' => 'btn btn-success'])
            ->finDiv()
            ->finForm();

        $this->render('series/detail', ['serie' => $serie, 'credits' => $credits, 'formComment' => $form->create()], 'series');
    }

    // public function saison()
    // {
    //     $this->render('series/saison', [], 'series');
    // }

    public function saison(string $saisonNum, string $id)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');
        
        $serie = $api->getSerie($id);
        $credits = $api->getCredits($id);
        $saison = $api->getSaison($id, $saisonNum);
        
        // $pageTitle = $serie['name'];
        // var_dump($pageTitle);
        $this->render('series/saison', ['saison' => $saison, 'serie' => $serie, 'credits' => $credits], 'series');

        // var_dump($saison);

    }
}