<?php
namespace App\Controllers;

use App\Core\OpenApi;

class SerieController extends Controller
{
    public function detail(string $id)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $serie = $api->getSerie($id);
        $credits = $api->getCredits($id);

        $this->render('series/detail', ['serie' => $serie, 'credits' => $credits], 'series');
    }

    public function saison(string $id, string $saisonNum)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $saison = $api->getSaison($id, $saisonNum);

        // $this->render('series/saison', ['saison' => $saison], 'serie');
    }
}