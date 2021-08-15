<?php $pageTitle = "Rechercher Acteurs";
// Pagination
if(isset($popCelebs['page']) && !empty($popCelebs['page'])){
    $currentPage = $popCelebs['page'];
} else {
    $currentPage = 1;
}
?>
<h1>Recherche d'un(e) ou des acteur(s) ou actrice(s)</h1>
<?= $formSearch ?>
<br>

<div id="ligne"></div>
<br>
<?php if ($search) : ?>

    <div class="row">
        <?php foreach ($search as $person) : ?>
            <div class="col-sm-6 col-md-3">
                <a href="/person/bio/<?= $person['id'] ?>" target="_blank">
                    <div class="card text-white bg-success mb-3">
                        <img src="<?= !$person['profil'] ? '/img/avatar.png' : 'https://image.tmdb.org/t/p/w300/' . $person['profil'] ?>" class="card-img-top" alt="image de <?= $person['nom'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $person['nom'] ?></h5>
                            <p class="card-text">
                                Domaine : <?= !$person['job'] ? "Pas d'information" : $person['job'] ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div><!-- fin row -->
<?php else: ?>
    <div class="row">
    <h2>Le classement des personnalités populaires</h2>
        <p></p>

        <?php foreach($popCelebs['results'] as $celebs): ?>
            <div class="col-sm-6 col-md-3">
                <a href="/person/bio/<?= $celebs['id'] ?>" target="_blank">
                    <div class="card text-white bg-success mb-3">
                        <img src="<?= !$celebs['profile_path'] ? '/img/avatar.png' : 'https://image.tmdb.org/t/p/w300/' . $celebs['profile_path'] ?>" class="card-img-top" alt="image de <?= $celebs['name'] ?>" id="popular">
                        <div class="card-body">
                            <h5 class="card-title"><?= $celebs['name'] ?></h5>
                            <p class="card-text">
                                Domaine : <?= !$celebs['known_for_department'] ? "Pas d'information" : $celebs['known_for_department'] ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>

        <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a href="/search/person" class="page-link"><i class="fas fa-step-backward"></i></a>
                </li>
                <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a href="/search/person/<?= $currentPage - 1 ?>" class="page-link"><i class="fas fa-backward"></i></a>
                </li>
                <li class="page-item">
                    <p class="page-link"><?= $popCelebs['page'] ?></p>
                </li>
                <li class="page-item <?= ($currentPage === $popCelebs['pagesTotales']) ? 'disabled' : '' ?>">
                    <a href="/search/person/<?= $currentPage + 1 ?>" class="page-link"><i class="fas fa-forward"></i></a>
                </li>
                <li class="page-item <?= ($currentPage === $popCelebs['pagesTotales']) ? 'disabled' : '' ?>">
                    <a href="/search/person/<?= $popCelebs['pagesTotales'] ?>" class="page-link"><i class="fas fa-step-forward"></i></a>
                </li>
            </ul>
        </nav>
    </div><!-- fin row -->
<?php endif ?>