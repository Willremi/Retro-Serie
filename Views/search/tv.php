<?php
$pageTitle = "Rechercher série(s)";
// var_dump($_POST);
?>
<h1>Recherche d'une ou des série(s)</h1>
<?= $formSearch ?>
<br>
<?php if ($search) : ?>
    <div id="ligne"></div>
    <br>
    <div class="row">

        <!-- <br> -->
        <?php foreach ($search as $series) : ?>

            <div class="col-sm-6 col-md-3">
                <a href="/serie/detail/<?= $series['idSerie'] ?>" target="_blank">

                    <div class="card border-success mb-3">
                        <div class="card-header"><?= $series['name'] ?></div>
                        <img src="<?= !$series['poster'] ? '/img/LogoTV300.png' : 'https://image.tmdb.org/t/p/w300/' . $series['poster'] ?>" class="card-img-top" alt="...">

                        <div class="card-body text-success">
                            <h5 class="card-title"><?= $series['nameOrigin'] ?></h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div> <!-- Fin row -->
<?php endif ?>