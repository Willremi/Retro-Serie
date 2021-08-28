<?php
$url = explode('/', $_GET['p']);

if($url[2] == 'all') {
    $pageTitle = "Séries entre 1950/2009";
} else {
    $pageTitle = "Séries des années " . $url[2];
}

// Pagination
if(isset($series['page']) && !empty($series['page'])) {
    $currentPage = $series['page'];
} else {
    $currentPage = 1;
}
?>
<h1>Liste des séries populaires<?= ($url[2] == 'all') ? '' : ' des années '.$url[2] ?></h1>
<div id="ligne"></div>
<main>
    <!-- Navigation par décennies -->
    <ul class="nav justify-content-center">
        <li class="nav-item <?= ($url[2] == 1950) ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/1950">1950</a>
        </li>
        <li class="nav-item <?= ($url[2] == 1960) ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/1960">1960</a>
        </li>
        <li class="nav-item <?= ($url[2] == 1970) ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/1970">1970</a>
        </li>
        <li class="nav-item <?= ($url[2] == 1980) ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/1980">1980</a>
        </li>
        <li class="nav-item <?= ($url[2] == 1990) ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/1990">1990</a>
        </li>
        <li class="nav-item <?= ($url[2] == 2000) ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/2000">2000</a>
        </li>
        <li class="nav-item <?= ($url[2] == 'all') ? 'd-none' : '' ?>">
            <a class="nav-link annees" href="/listSerie/annees/all">Toutes</a>
        </li>
    </ul>
    <br>
    <!-- Liste des séries -->
    <div class="row">
        <?php foreach ($series['results'] as $serie) : ?>
            <div class="col-sm-6 col-md-3">
                <a href="/serie/detail/<?= $serie['id'] ?>" target="_blank">
                    <div class="card text-white bg-warning mb-3 seriesPop">
                        <div class="card-header"><?= $serie['name'] ?></div>
                        <!-- <img src="<?= !$serie['poster_path'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w300/' . $serie['poster_path'] ?>" class="card-img-top" id="popular" alt="image de <?= $serie['name'] ?>"> -->
                        <div class="card-body">
                            <h6 class="card-title"><strong><?= $serie['original_name'] ?></strong></h6>
                            <p class="card-text">
                                Pays d'origine : <?= !$serie['origin_country'] ? "Pas d'information sur le pays" : $serie['origin_country'][0] ?><br>
                                Date de diffusion : <?= date('d/m/Y', strtotime($serie['first_air_date'])) ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a href="/listSerie/annees/<?= $url[2] ?>" class="page-link"><i class="fas fa-step-backward"></i></a>
                </li>
                <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a href="/listSerie/annees/<?= $url[2] ?>/<?= $currentPage - 1 ?>" class="page-link"><i class="fas fa-backward"></i></a>
                </li>
                <li class="page-item">
                    <p class="page-link"><?= $series['page'] ?></p>
                </li>
                <li class="page-item <?= ($currentPage === $series['pagesTotales']) ? 'disabled' : '' ?>">
                    <a href="/listSerie/annees/<?= $url[2] ?>/<?= $currentPage + 1 ?>" class="page-link"><i class="fas fa-forward"></i></a>
                </li>
                <li class="page-item <?= ($currentPage === $series['pagesTotales']) ? 'disabled' : '' ?>">
                    <a href="/listSerie/annees/<?= $url[2] ?>/<?= $series['pagesTotales'] ?>" class="page-link"><i class="fas fa-step-forward"></i></a>
                </li>
            </ul>
        </nav>
    </div><!-- fin row -->
</main>