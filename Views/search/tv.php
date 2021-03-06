<?php
$pageTitle = "Rechercher série(s)";
// var_dump($_POST);
?>
<h1>Recherche d'une ou des série(s)</h1>
<?= $formSearch ?>
<br>
<div id="ligne"></div>
<br>
<?php if ($search) : ?>
    <div class="row">

        <!-- <br> -->
        <?php foreach ($search as $series) : ?>

            <div class="col-sm-6 col-md-3">
                <a href="/serie/detail/<?= $series['idSerie'] ?>" target="_blank" id="search">

                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><?= $series['name'] ?></div>
                        <img src="<?= !$series['poster'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w300/' . $series['poster'] ?>" class="card-img-top" alt="image de <?= $series['name'] ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?= $series['nameOrigin'] ?></h5>
                            <p class="card-text">
                                Pays d'origine : <?= !$series['paysOrigin'] ? "Pas d'information sur le pays" : $series['paysOrigin'][0] ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div> <!-- Fin row -->
<?php else : ?>

    <h2>Le classement des 20 séries populaires entre 1950 et 2010</h2>
    <div>
        <p class="years">Liste des séries :
            <a href="/listSerie/annees/1950" target="_blank">Années 50</a> /
            <a href="/listSerie/annees/1960" target="_blank">Années 60</a> /
            <a href="/listSerie/annees/1970" target="_blank">Années 70</a> /
            <a href="/listSerie/annees/1980" target="_blank">Années 80</a> /
            <a href="/listSerie/annees/1990" target="_blank">Années 90</a> /
            <a href="/listSerie/annees/2000" target="_blank">Années 2000</a>
            <a href="/listSerie/annees/all" target="_blank">Toutes</a>
        </p>
    </div>
    <div class="row">
        <?php foreach ($popTv as $pop) : ?>
            <div class="col-sm-6 col-md-3">
                <a href="/serie/detail/<?= $pop['idSerie'] ?>" target="_blank">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><?= $pop['nom'] ?></div>
                        <img src="<?= !$pop['poster'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w300/' . $pop['poster'] ?>" class="card-img-top" alt="image de <?= $pop['nom'] ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?= $pop['nomOrigin'] ?></h5>
                            <p class="card-text">
                                Pays d'origine : <?= !$pop['paysOrigin'] ? "Pas d'information sur le pays" : $pop['paysOrigin'][0] ?><br>
                                Date de diffusion : <?= $pop['dateDiff'] ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div><!-- fin row -->
<?php endif ?>