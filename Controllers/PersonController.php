<?php
namespace App\Controllers;

use App\Core\OpenApi;

class PersonController extends Controller
{
    /**
     * Fonction pour appeler la biographie d'un acteur ou réalisateur
     *
     * @param string $id
     * @return void
     */
    public function bio (string $id)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $bio = $api->getPerson($id);
        $this->render('person/bio', ['bio' => $bio], 'series');
        var_dump($bio);
    }
}