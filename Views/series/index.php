<?php

use App\Core\OpenApi;

$pageTitle = "Liste des séries";

// $api = new OpenApi('c595147bf4af143ab2df16843f9487bf');
?>
<h1>Liste des séries par décennies</h1>
<div id="ligne"></div>
<ul class="nav justify-content-center">
    <li class="nav-item">
        <p class="nav-link">
            <button class="btn btn-primary decennie" id="btn50">1950</button>
        </p>
    </li>
    <li class="nav-item">
        <p class="nav-link">
            <button class="btn btn-success decennie" id="btn60">1960</button>
        </p>
    </li>
    <li class="nav-item">
        <p class="nav-link">
            <button class="btn btn-warning decennie" id="btn70">1970</button>
        </p>
    </li>
    <li class="nav-item">
        <p class="nav-link">
            <button class="btn btn-danger decennie" id="btn80">1980</button>
        </p>
    </li>
    <li class="nav-item">
        <p class="nav-link">
            <button class="btn btn-dark decennie" id="btn90">1990</button>
        </p>
    </li>
    <li class="nav-item">
        <p class="nav-link">
            <button class="btn btn-info decennie" id="btn2000"> 2000</button>
        </p>
    </li>
</ul>

<div id="annees50" class="table-responsive-sm listSerie">
    <?php $list50 = $api->getList('140995'); ?>
    <h2>Séries des années 50</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list50 as $liste) : ?>
                <tr class="liste">
                    <td class="bg-primary"><a href="serie/detail/<?= $liste['idSerie'] ?>" target="_blank"><?= $liste['name'] ?></a></td>
                    <td class="bg-primary"><?= $liste['paysOrigin'] ?></td>
                    <td class="bg-primary"><?= $liste['dateDiff'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div id="annees60" class="table-responsive-sm listSerie">
    <?php $list60 = $api->getList('140997'); ?>
    <h2>Séries des années 60</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list60 as $liste) : ?>
                <tr class="liste">
                    <td class="bg-success"><a href="serie/detail/<?= $liste['idSerie'] ?>" target="_blank"><?= $liste['name'] ?></a></td>
                    <td class="bg-success"><?= $liste['paysOrigin'] ?></td>
                    <td class="bg-success"><?= $liste['dateDiff'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div id="annees70" class="table-responsive-sm listSerie">
    <?php $list70 = $api->getList('140999'); ?>
    <h2>Séries des années 70</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list70 as $liste) : ?>
                <tr class="liste">
                    <td class="bg-warning"><a href="serie/detail/<?= $liste['idSerie'] ?>" target="_blank"><?= $liste['name'] ?></a></td>
                    <td class="bg-warning"><?= $liste['paysOrigin'] ?></td>
                    <td class="bg-warning"><?= $liste['dateDiff'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div id="annees80" class="table-responsive-sm listSerie">
    <?php $list80 = $api->getList('141000'); ?>
    <h2>Séries des années 80</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list80 as $liste) : ?>
                <tr class="liste">
                    <td class="bg-danger"><a href="serie/detail/<?= $liste['idSerie'] ?>" target="_blank"><?= $liste['name'] ?></a></td>
                    <td class="bg-danger"><?= $liste['paysOrigin'] ?></td>
                    <td class="bg-danger"><?= $liste['dateDiff'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div id="annees90" class="table-responsive-sm listSerie">
    <?php $list90 = $api->getList('141003'); ?>
    <h2>Séries des années 90</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list90 as $liste) : ?>
                <tr class="liste">
                    <td class="bg-dark"><a href="serie/detail/<?= $liste['idSerie'] ?>" target="_blank"><?= $liste['name'] ?></a></td>
                    <td class="bg-dark"><?= $liste['paysOrigin'] ?></td>
                    <td class="bg-dark"><?= $liste['dateDiff'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div id="annees2000" class="table-responsive-sm listSerie">
    <?php $list2000 = $api->getList('141005'); ?>
    <h2>Séries des années 2000</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list2000 as $liste) : ?>
                <tr class="liste">
                    <td class="bg-info"><a href="serie/detail/<?= $liste['idSerie'] ?>" target="_blank"><?= $liste['name'] ?></a></td>
                    <td class="bg-info"><?= $liste['paysOrigin'] ?></td>
                    <td class="bg-info"><?= $liste['dateDiff'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Créer une page serie/idSerie
    ajouter dans OpenSerie -> showTv(id) -->

<!-- <div id="annees50" class="table-responsive-sm listSerie">
    <h2>Séries des années 50</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-primary">Les aventures de Superman</td>
                <td class="bg-primary">USA</td>
                <td class="bg-primary">1952 - 1958</td>
            </tr>
            <tr>
                <td class="bg-primary">Ivanhoé</td>
                <td class="bg-primary">Royaume-Uni</td>
                <td class="bg-primary">1958 - 1959</td>
            </tr>
        </tbody>
    </table>
</div> -->

<!-- <div id="annees60" class="table-responsive-sm listSerie">
    <h2>Séries des années 60</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-success">Les Sentinelles de l'air</td>
                <td class="bg-success">Royaume-Uni</td>
                <td class="bg-success">1965 - 1966</td>
            </tr>
            <tr>
                <td class="bg-success">Bonne nuit les petits</td>
                <td class="bg-success">France</td>
                <td class="bg-success">1962 - 1973</td>
            </tr>
        </tbody>
    </table>
</div> -->

<!-- <div id="annees70" class="table-responsive-sm listSerie">
    <h2>Séries des années 70</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-warning">Cosmos 1999</td>
                <td class="bg-warning">Royaume-Uni</td>
                <td class="bg-warning">1975 - 1977</td>
            </tr>
            <tr>
                <td class="bg-warning">Sandokan</td>
                <td class="bg-warning">Italie - France</td>
                <td class="bg-warning">1976</td>
            </tr>
        </tbody>
    </table>
</div> -->

<!-- <div id="annees80" class="table-responsive-sm listSerie">
    <h2>Séries des années 80</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-danger">Deux flics à Miami</td>
                <td class="bg-danger">Etats-Unis</td>
                <td class="bg-danger">1984 - 1990</td>
            </tr>
            <tr>
                <td class="bg-danger">Alf</td>
                <td class="bg-danger">Etats-Unis</td>
                <td class="bg-danger">1986 - 1990</td>
            </tr>
        </tbody>
    </table>
</div> -->

<!-- <div id="annees90" class="table-responsive-sm listSerie">
    <h2>Séries des années 90</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-dark">Maigret</td>
                <td class="bg-dark">France</td>
                <td class="bg-dark">1991 - 2004</td>
            </tr>
            <tr>
                <td class="bg-dark">Buffy contre les vampires</td>
                <td class="bg-dark">Etats-Unis</td>
                <td class="bg-dark">1997 - 2003</td>
            </tr>
        </tbody>
    </table>
</div> -->

<!-- <div id="annees2000" class="table-responsive-sm listSerie">
    <h2>Séries des années 2000</h2>
    <table class="table table-light table-bordered">
        <thead>
            <tr>
                <th scope="col">Noms</th>
                <th scope="col">Pays</th>
                <th scope="col">Années de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-info">H2O</td>
                <td class="bg-info">Australie</td>
                <td class="bg-info">2006 - 2010</td>
            </tr>
            <tr>
                <td class="bg-info">Skins</td>
                <td class="bg-info">Royaume-Uni</td>
                <td class="bg-info">2007 - 2013</td>
            </tr>
        </tbody>
    </table>
</div> -->