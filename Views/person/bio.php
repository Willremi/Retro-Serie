<?php
// var_dump($bio);
$pageTitle = $bio['name'];

$notInfo = "Pas d'infos disponibles";
?>

<h1><?= $bio['name'] ?></h1>

<img src="<?= !$bio['photo'] ? '/img/avatar.png' : 'https://image.tmdb.org/t/p/w154/' . $bio['photo'] ?>" alt="Photo de <?= $bio['name'] ?>" class="rounded">

<div class="offset-md-5 col-md-4">
    <p>Date de naissance : <?= $bio['dateBirth'] ?></p>
    <?= ($bio['dateDeath'] !== '01/01/1970') ? "<p>Date de décès : {$bio['dateDeath']}</p>" : "" ?>
</div>