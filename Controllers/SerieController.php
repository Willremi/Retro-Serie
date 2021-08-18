<?php
namespace App\Controllers;

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

        $this->render('series/detail', ['serie' => $serie, 'credits' => $credits], 'series');
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