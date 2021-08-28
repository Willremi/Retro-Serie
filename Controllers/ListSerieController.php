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

    public function annees(string $id, $page = 1)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');
        // if($id == 1950) {
        //     var_dump($_GET);
        // }
        switch ($id) {
            case '1950':
                $series = $api->getListByYear('1950', '1959', $page);
                // var_dump($series);
                break;
            case '1960':
                $series = $api->getListByYear('1960', '1969', $page);
                // var_dump($series);
                break;
            case '1970':
                $series = $api->getListByYear('1970', '1979', $page);
                // var_dump($series);
                break;
            case '1980':
                $series = $api->getListByYear('1980', '1989', $page);
                // var_dump($series);
                break;
            case '1990':
                $series = $api->getListByYear('1990', '1999', $page);
                // var_dump($series);
                break;
            case '2000':
                $series = $api->getListByYear('2000', '2009', $page);
                // var_dump($series);
                break;
            case 'all':
                $series = $api->getListByYear('1950', '2009', $page);
                // var_dump($series);
                break;
            
            default:
                header('Location: /search/tv');
                break;
        }
        $this->render('series/annees', ['series' => $series], 'series');
    }
}
