<?php
// var_dump($serie);

use App\Models\UsersModel;

$pageTitle = $serie['name'];

$notInfo = "Pas d'infos disponibles";
?>
<h1><?= $serie['name'] ?></h1>
<?php if ($serie['name'] !== $serie['nameOrigin']) : ?>
    <h4><?= $serie['nameOrigin'] ?></h4>
<?php endif ?>
<div id="ligne"></div>
<br>
<div class="row">
    <div class="col-md-6 order-sm-1 order-md-0" id="infos">
        <ul>

            <li>Genre : <?= !$serie['genre'] ? $notInfo : $serie['genre'][0]['name'] ?></li>
            <li>Pays de production : <?= !$serie['pays'] ? $notInfo : $serie['pays'][0]['name'] ?></li>
            <?= $serie['creator'] ? "<li>Création : {$serie['creator'][0]['name']}</li>" : "" ?>
            <li>Diffuseur : <?= !$serie['diffuseur'] ? $notInfo : $serie['diffuseur'] ?></li>
            <li>Nombre de saisons : <?= $serie['nbSaison'] ?></li>
            <li>Nombre d'épisodes : <?= $serie['nbEpisode'] ?></li>
            <li>Date du premier épisode : <?= $serie['dateFirstDiff'] ?></li>
            <li>Date du dernier épisode : <?= $serie['dateLastDiff'] ?></li>
            <li>Statut : <?= $serie['statut'] === 'Ended' ? 'Terminé' : 'En cours' ?></li>
        </ul>
    </div>
    <div class="col-md-6 order-sm-0 order-md-1">
        <img src="<?= !$serie['photo'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w500/' . $serie['photo'] ?>" alt="photo de <?= $serie['name'] ?>" class="rounded">
    </div>
</div> <!-- fin row-->
<br>
<div id="ligne"></div>
<main>
    <h2>Résumé</h2>
    <p class="<?= !$serie['resume'] ? 'resumeNull' : '' ?>"><?= !$serie['resume'] ? 'Aucune information sur le résumé' : $serie['resume'] ?></p>

    <div id="ligne"></div>

    <div class="row">
        <!-- <div class="col-md-6"> -->
        <div class="<?= $credits['crew'] === [] ? 'offset-md-1 col-md-10' : 'col-md-6' ?>">
            <!-- <h2>Distribution</h2> -->
            <?php if ($credits['cast']) : ?>
                <h2>Distribution</h2>

                <table class="table-respo table table-success table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Acteurs</th>
                            <th scope="col">Rôles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($credits['cast'] as $cast) : ?>
                            <tr>
                                <td><a href="/person/bio/<?= $cast['id'] ?>" target="_blank"><?= $cast['name'] ?></a></td>
                                <td><?= $cast['character'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
        <!-- <div class="col-md-6"> -->
        <div class="<?= $credits['cast'] === [] ? 'offset-md-1 col-md-10' : 'col-md-6' ?>">
            <!-- <h2>Production</h2> -->
            <?php if ($credits['crew']) : ?>
                <h2>Production</h2>
                <table class="table-respo table table-success table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Noms</th>
                            <th scope="col">Métiers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($credits['crew'] as $crew) : ?>
                            <tr>
                                <td><a href="/person/bio/<?= $crew['id'] ?>" target="_blank"><?= $crew['name'] ?></a></td>
                                <td><?= $crew['job'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>

        </div>
    </div><!--  fin row -->

    <div id="ligne"></div>

    <h2><?= $serie['nbSaison'] <= 1 ? 'Saison' : 'Liste des saisons' ?></h2>
    <div class="row">
        <table class="table-respo table-bordered border-success">
            <thead>
                <tr>
                    <th scope="col"><?= $serie['nbSaison'] === 1 ? 'Saison' : 'Saisons' ?></th>
                    <th scope="col">Nombre d'épisodes</th>
                    <th scope="col">Dates de diffusion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($serie['saisons'] as $saison) : ?>

                    <tr class="saisons">

                        <?php
                        if ($saison['name'] !== 'Épisodes spéciaux' && $saison['name'] !== 'Specials') : ?>
                            <td><a href="/serie/saison/<?= $saison['season_number'] ?>/<?= $serie['id'] ?>" target="_blank"><?= $saison['name'] ?></a></td>
                            <td><?= $saison['episode_count'] ?></td>
                            <td><?= $saison['air_date'] ? date('d/m/Y', strtotime($saison['air_date'])) : "Pas d'infos disponibles" ?></td>

                        <?php endif ?>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>
    </div><!--  fin row -->
    <br>
    <div id="ligne"></div>
    <h2>Commentaires</h2>
    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
        <?= $formComment ?>
    <?php else : ?>
        <a href="/users/login" class="btn btn-primary" target="_blank">Se Connecter</a> <a href="/users/register" class="btn btn-warning text-white" target="_blank">S'inscrire</a>
    <?php endif ?>
    <hr>
    <div class="col-sm-12 col-md-12" id="commentaires">
        <div class="offset-md-3 col-md-6">
            <h4>Nombre de commentaires : <?= count($commentaires) ?></h4>
        </div>
        <?php
        rsort($commentaires);
        foreach ($commentaires as $comment) {
            $users = new UsersModel;
            $date = date_create($comment->created_at);
            $user = (object) $users->find($comment->users_id);
        ?>
            <div class="card border-success mb-3 offset-md-3 col-md-6">
                <div class="card-header bg-success text-white"><?= ucfirst($user->pseudo) ?> | <?= date_format($date, 'd/m/y à H:i') ?></div>
                <div class="card-body text-success">
                    <p class="card-text"><?= $comment->content ?></p>
                </div>
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id']) && $_SESSION['user']['id'] == $comment->users_id) : ?>
                    <div class="card-footer">
                    <button class="suppComment btn btn-primary" data-id="<?= $comment->id ?>">Supprimer ce commentaire</button>
                </div>
                <?php endif ?>
            </div>
        <?php } ?>
        <!-- endforeach -->

    </div>

</main>
<?php
// var_dump(date_format($commentaires['created_at'], 'd/m/Y à H:i:s'));
// foreach($commentaires as $comment) {
//     $users = new UsersModel;
//     $date = date_create($comment->created_at);
//     // echo date_format($date, 'd/m/Y à H:i:s').'<br>';
//     if((int)$comment->idSerie === $serie['id']) {
//         $user = (object) $users->find($comment->users_id);
//         echo '<p>'.$comment->content.' écrit par '.$user->pseudo.' le <strong>'.date_format($date, 'd/m/y à H:i').'</strong></p>';
//     }
// }
// 