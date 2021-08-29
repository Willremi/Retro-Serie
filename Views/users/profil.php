<?php

$pageTitle = "Profil de $user->pseudo" ?>
<h2><?= $user->pseudo ?></h2>
<div>
    <h5>Email : <?= $user->email ?></h5>
    <a class="btn btn-warning" href="/users/modifier/<?= $user->id ?>">Modifier vos informations</a>
    <a id="delete" class="btn btn-danger" href="/users/supprimeUser/<?= $user->id ?>">Supprimer votre compte</a>
</div>
<hr>
<h3>Votre activité sur le site</h3>
<div class="row">
    <div class="">
        <p><strong>Nombre de commentaires sur le site : </strong><?= count($commentaires) ?></p>
        <?php if($commentaires):
            $lastComment = end($commentaires);
            $serie = $api->getSerie($lastComment->idSerie);
            $date = date_create($lastComment->created_at);
            ?>
            <p><strong>Dernier commentaire d'une série : </strong><?= $serie['name'] ?> (Posté le <?= date_format($date, 'd/m/y à H:i') ?>) <a href="/serie/detail/<?= $serie['id'] ?>#commentaires">Voir le commentaire</a></p>
        <?php endif ?>
    </div>
</div><!-- fin row --> 
