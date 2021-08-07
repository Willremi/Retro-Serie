<?php
$pageTitle = $saison['name'] . ' : ' . $serie['name'];

$notInfo = "Pas d'infos disponibles";
?>
<h1><?= $serie['name'] ?></h1>
<h2><?= $saison['name'] ?></h2>
<br>
<div id="ligne"></div>
<br>
<div class="row justify-content-sm-between">
    <div class="offset-sm-3 col-md-4 ms-md-auto">
        <p><strong>Date de diffusion : </strong><?= $saison['dateDiff'] ?></p>
    </div>
    <div class="offset-sm-3 col-md-4 ms-md-auto">
        <p><strong>Nombre d'épisodes : </strong><?= count($saison['episodes']) ?></p>
    </div>
</div> <!-- fin row -->
<main>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div id="ligne"></div>
        </div>
    </div>
    <br>
    <!-- Intro -->
    <p id="introSaison">La page présente le guide des épisodes de la <strong>saison <?= $saison['numSaison'] ?></strong> de la série télévisée <a href="/serie/detail/<?= $serie['id'] ?>"><strong><?= $serie['name'] ?></strong></a>.</p>

    <img src="<?= !$saison['cover'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w300/' . $saison['cover'] ?>" alt="photo de couverture" class="rounded">

    <br><br>

    <!-- Pagination -->
    <?php
    if (isset($saison['numSaison']) && !empty($saison['numSaison'])) {
        $currentPage = $saison['numSaison'];
    } else {
        $currentPage = 1;
    }
    ?>

    <!-- Navigation de pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/1/<?= $serie['id'] ?>"><i class="fas fa-step-backward"></i></a>
            </li>
            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/<?= $currentPage - 1 ?>/<?= $serie['id'] ?>"><i class="fas fa-backward"></i></a>
            </li>
            <li class="page-item">
                <p class="page-link"><?= $saison['name'] ?></p>
            </li>
            <li class="page-item <?= ($currentPage === $serie['nbSaison']) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/<?= $currentPage + 1 ?>/<?= $serie['id'] ?>"><i class="fas fa-forward"></i></a>
            </li>
            <li class="page-item <?= ($currentPage === $serie['nbSaison']) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/<?= $serie['nbSaison'] ?>/<?= $serie['id'] ?>"><i class="fas fa-step-forward"></i></a>
            </li>
        </ul>
    </nav>

    <h2>Acteurs principaux</h2>
    <?= ($credits['cast'] === []) ? "<p class='resumeNull'>" . $notInfo . " sur les acteurs principaux</p>" : "<p></p>" ?>
    <br>

    <div class="row">

        <?php foreach ($credits['cast'] as $cast) : ?>
            <div class="col-md-4 col-sm-4 mb-2">
                <a href="/person/bio/<?= $cast['id'] ?>" target="_blank">
                <img src="<?= !$cast['profile_path'] ? '/img/avatar.png' : 'https://image.tmdb.org/t/p/w154/' . $cast['profile_path'] ?>" alt="Photo de <?= $cast['name'] ?>" class="celebs rounded">

                <h5><?= $cast['name'] ?></h5>
                </a>
            </div>
        <?php endforeach ?>
    </div> <!-- fin row -->

    <!-- Liste des épisodes -->
    <h2><?= count($saison['episodes']) === 1 ? "Episode" : "Liste des épisodes"  ?></h2>

    <div class="row">
        <table class="table-respo table-bordered border-success">
            <thead>
                <tr>
                    <th scope="col">Dates de diffusion</th>
                    <th scope="col">Episodes</th>
                    <th scope="col">Titres</th>
                    <th scope="col">Résumés</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saison['episodes'] as $episode) : ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($episode['air_date'])) ?></td>
                        <td><?= $episode['episode_number'] ?></td>
                        <td><?= $episode['name'] ?></td>
                        <td><?= !$episode['overview'] ? $notInfo : $episode['overview'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div><!-- Fin row -->

    <br>
    <!-- Navigation de pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/1/<?= $serie['id'] ?>"><i class="fas fa-step-backward"></i></a>
            </li>
            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/<?= $currentPage - 1 ?>/<?= $serie['id'] ?>"><i class="fas fa-backward"></i></a>
            </li>
            <li class="page-item">
                <p class="page-link"><?= $saison['name'] ?></p>
            </li>
            <li class="page-item <?= ($currentPage === $serie['nbSaison']) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/<?= $serie['nbSaison'] ?>/<?= $currentPage + 1 ?>"><i class="fas fa-forward"></i></a>
            </li>
            <li class="page-item <?= ($currentPage === $serie['nbSaison']) ? 'disabled' : '' ?>">
                <a class="page-link" href="/serie/saison/<?= $serie['nbSaison'] ?>/<?= $serie['id'] ?>"><i class="fas fa-step-forward"></i></a>
            </li>
        </ul>
    </nav>
</main>

<?php
// var_dump(count($saison['episodes']));