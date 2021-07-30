<?php
namespace App\Controllers;

use App\Core\OpenApi;

class SerieController extends Controller
{
    public function detail(string $id)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $serie = $api->getSerie($id);

        $this->render('series/detail', compact('serie'), 'series');
    }
}