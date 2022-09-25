<?php
// var_dump($bio);
$pageTitle = $bio['name'];

$notInfo = "Pas d'infos disponibles";
?>

<h1><?= $bio['name'] ?></h1>

<img src="<?= !$bio['photo'] ? '/img/avatar.png' : 'https://image.tmdb.org/t/p/w154/' . $bio['photo'] ?>" alt="Photo de <?= $bio['name'] ?>" class="rounded">

<p class="introBio"><?= ($bio['sexe'] === 1) ? 'Née' : 'Né' ?> le <?= $bio['dateBirth'] ?><?= $bio['placeBirth'] ? " à {$bio['placeBirth']} " : " " ?><br>
    <?= ($bio['dateDeath'] !== '01/01/1970') ? "Date de décès : {$bio['dateDeath']}</p>" : "" ?>
<div id="ligne"></div>
<br>
<p class="<?= !$bio['bio'] ? 'resumeNull' : '' ?>"><u><strong>Bio :</strong></u> <?= !$bio['bio'] ? $notInfo : $bio['bio'] ?></p>
<div id="ligne"></div>

<?php
$dateNaissance = explode('/', $bio['dateBirth']);
$anneeNaissance = $dateNaissance[2];

$dateMort = explode('/', $bio['dateDeath']);
$anneeMort = $dateMort[2];

// var_dump($anneeMort);
// Tri json par date décroissant
// Cast
usort($credits['cast'], function ($a, $b) {
    return $b['first_air_date'] <=> $a['first_air_date'];
});
// Crew
usort($credits['crew'], function ($a, $b) {
    return $b['first_air_date'] <=> $a['first_air_date'];
});

?>
<br>
<div class="row">
    
    <div class="<?= $credits['crew'] === [] ? 'offset-md-1 col-md-10' : 'col-md-6' ?>">
        <?php if($credits['cast']): ?>
            <h2>Interprétations</h2>
            <table class="table-respo table table-success table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Années</th>
                        <th scope="col">Séries</th>
                        <th scope="col">Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($credits['cast'] as $cast) : ?>
                        <tr>
                            <?php
                            $anneeRole = date('Y', strtotime($cast['first_air_date']));
                            if ($anneeRole > $anneeNaissance) : ?>
                                <td><?= $anneeRole ?></td>
                                <td><a href="/serie/detail/<?= $cast['id'] ?>" target="_blank"><?= $cast['name'] ?></a></td>
                                <td><?= $cast['character'] ?></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
    <div class="<?= $credits['cast'] === [] ? 'offset-md-1 col-md-10' : 'col-md-6' ?>">
        <?php if($credits['crew']): ?>
            <h2>Productions</h2>
            <table class="table-respo table table-success table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Années</th>
                        <th scope="col">Séries</th>
                        <th scope="col">Métiers</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($credits['crew'] as $crew) : ?>
                        <tr>
                            <?php
                            $anneeReal = $crew['first_air_date'] ? date('Y', strtotime($crew['first_air_date'])) : "Pas d'infos disponibles";
                            if ($anneeReal > $anneeNaissance) :
                            ?>
                                <td><?= $anneeReal ?></td>
                                <td><a href="/serie/detail/<?= $crew['id'] ?>" target="_blank"><?= $crew['name'] ?></a></td>
                                <td><?= $crew['job'] ?></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>