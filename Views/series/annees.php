<?php 
$url = explode('/', $_GET['p']);
$pageTitle = "Séries des années ".$url[2];
?>
<h1>Liste des séries populaires des années <?= $url[2] ?></h1>
<div id="ligne"></div>
<main>
<div class="row">
    
    <?php foreach($series['results'] as $serie): ?>
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