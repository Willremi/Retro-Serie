<?php
// var_dump($serie);
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
    <div class="col-md-6 order-sm-1 order-md-0">
        <ul>
            <li>Genre : <?= $serie['genre'] ?></li>
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
            <?= $credits['cast'] === [] ? '' : '<h2>Distribution</h2>' ?>
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
                            <td><?= $cast['name'] ?></td>
                            <td><?= $cast['character'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- <div class="col-md-6"> -->
        <div class="<?= $credits['cast'] === [] ? 'offset-md-1 col-md-10' : 'col-md-6' ?>">
            <!-- <h2>Production</h2> -->
            <?= $credits['crew'] === [] ? '' : '<h2>Production</h2>' ?>
            <table class="table-respo table table-success table-striped table-bordered">
                <?php foreach ($credits['crew'] as $crew) : ?>
                    <tr>
                        <td><?= $crew['name'] ?></td>
                        <td><?= $crew['job'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
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
                            <td><?= date('d/m/Y', strtotime($saison['air_date'])) ?></td>

                        <?php endif ?>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>
    </div><!--  fin row -->

   <div id="ligne"></div>

</main>
<?php
// var_dump($serie['pays']);
// var_dump($credits);
// var_dump($serie['production'][0]['name']);
