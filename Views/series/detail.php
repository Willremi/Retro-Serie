<?php
// var_dump($serie);
$pageTitle = $serie['name'];
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
            <li>Pays de production : <?= $serie['pays'] ?></li>
            <!-- <li>Production : </li> -->
            <li>Nombre de saison : <?= $serie['nbSaison'] ?></li>
            <li>Nombre de saison : <?= $serie['nbEpisode'] ?></li>
            <li>Date du premier épisode : <?= $serie['dateFirstDiff'] ?></li>
            <li>Date du dernier épisode : <?= $serie['dateLastDiff'] ?></li>
            <li>Diffuseur : <?= $serie['diffuseur'] ?></li>
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

    <h2><?= $serie['nbSaison'] <= 1 ? 'Saison' : 'Liste des saisons' ?></h2>
    <div class="row">
        <table class="table-respo table-bordered border-success">
            <thead>
                <tr>
                    <th scope="col"><?= $serie['nbSaison'] <= 1 ? 'Saison' : 'Saisons' ?></th>
                    <th scope="col">Nombres d'épisodes</th>
                    <th scope="col">Date de diffusion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($serie['saisons'] as $saison) : ?>
                    <tr class="saisons">
                        <td><?= $saison['name'] ?></td>
                        <td><?= $saison['episode_count'] ?></td>
                        <td><?= date('d/m/Y', strtotime($saison['air_date'])) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div><!--  fin row -->
    
    <br>
    <div id="ligne"></div>

    <div class="row">
        <div class="col-md-6">
            <h2>Distribution</h2>
        </div>
        <div class="col-md-6">
            <h2>Production</h2>
        </div>
    </div><!--  fin row -->
</main>
<?php
var_dump($serie);

// var_dump($serie['production'][0]['name']);
