<?php
$pageTitle = $saison['name'].' : '.$serie['name'];

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
<br>
<img src="https://image.tmdb.org/t/p/w300/<?= $saison['cover'] ?>" alt="photo de couverture" class="rounded">
<?php
// var_dump(count($saison['episodes']));