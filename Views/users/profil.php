<?php

$pageTitle = "Profil de $user->pseudo" ?>
<h2><?= $user->pseudo ?></h2>
<div>
    <h5>Email : <?= $user->email ?></h5>
    <a class="btn btn-warning" href="/users/modifier/<?= $user->id ?>">Modifier vos informations</a>
    <a id="delete" class="btn btn-danger" href="/users/supprimeUser/<?= $user->id ?>">Supprimer votre compte</a>
</div>
<?php

$list50 = $api->getList('140995');
$test = $api->getSerie('1532');

// var_dump($list50);

// var_dump($_SESSION['user']['actif']);
?>
<h2><?= $test['name'] ?></h2>