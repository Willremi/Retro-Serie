<?php
$url = explode('/', $_GET['p']);
$pageTitle = "Séries des années " . $url[2];
// Pagination par années
// if (isset($url[2]) && !empty($url[2])) {
//     $currentYear = $url[2];
// } else {
//     $currentYear = 1950;
// }
?>
<h1>Liste des séries populaires des années <?= $url[2] ?></h1>
<div id="ligne"></div>
<main>
    <!-- pagination -->
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
    </ul>
    <br>
    <!-- Liste des séries -->
    <div class="row">
        <?php foreach ($series['results'] as $serie) : ?>
            <div class="col-sm-6 col-md-3">
                <a href="/serie/detail/<?= $serie['id'] ?>" target="_blank">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><?= $serie['name'] ?></div>
                        <img src="<?= !$serie['poster_path'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w300/' . $serie['poster_path'] ?>" class="card-img-top" id="popular" alt="image de <?= $serie['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $serie['original_name'] ?></h5>
                            <p class="card-text">
                                Pays d'origine : <?= !$serie['origin_country'] ? "Pas d'information sur le pays" : $serie['origin_country'][0] ?><br>
                                Date de diffusion : <?= date('d/m/Y', strtotime($serie['first_air_date'])) ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div><!-- fin row -->
</main>