<?php

namespace App\Controllers;

use App\Core\Form;
use App\Core\OpenApi;
use App\Models\CommentairesModel;
use App\Models\UsersModel;

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

        if (Form::validate($_POST, ['commentaire'])) {
            $commentaire = htmlspecialchars(trim($_POST['commentaire']));

            // Instancier le modèle
            $coment = new CommentairesModel;

            // Hydratation
            $coment->setContent($commentaire)
                ->setIdSerie($serie['id'])
                ->setUsers_id($_SESSION['user']['id']);

            // Enregistrement
            $coment->create();
            $_SESSION['message'] = "Votre commentaire a bien été posté";
            header('Location: /serie/detail/' . $serie['id']);
            exit;
        }

        $form = new Form;

        $form->debutForm($methode = "post", $action = "", ['class' => 'row g-3'])
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutLabelFor('commentaire', 'Rédiger un commentaire')
            ->ajoutTextarea('commentaire', '', ['id' => 'commentaire', 'class' => 'form-control'])
            ->finDiv()
            ->debutDiv(['class' => 'offset-md-3 col-md-6'])
            ->ajoutBouton('Envoyer', ['class' => 'btn btn-success'])
            ->finDiv()
            ->finForm();

        // Recherche de commentaires actives
        $commentaireModel = new CommentairesModel;
        $commentaires = $commentaireModel->findBy(['actif' => 1]);

        // Recherche du pseudo à partir de l'id dans table commentaires(users_id)
        // $userModel = new UsersModel;
        // foreach($commentaires as $comt) {
        //     $users_id = $comt->users_id; 
        //     $user = $userModel->find($users_id);
        // }

        $this->render('series/detail', ['serie' => $serie, 'credits' => $credits, 'formComment' => $form->create(), 'commentaires' => $commentaires], 'series');
        // var_dump($serie['id']);
    }

    public function saison(string $saisonNum, string $id)
    {
        $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');

        $serie = $api->getSerie($id);
        $credits = $api->getCredits($id);
        $saison = $api->getSaison($id, $saisonNum);

        $this->render('series/saison', ['saison' => $saison, 'serie' => $serie, 'credits' => $credits], 'series');

        // var_dump($saison);

    }
}
