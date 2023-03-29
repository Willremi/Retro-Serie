<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? "Rétro Série" ?></title>
  <link rel="shortcut icon" href="/img/LogoTV.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="/img/LogoTV.png" alt="logoTv">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/listSerie">Liste</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="/search/tv">Séries</a>
            </li> -->
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Séries
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/search/tv">Recherche</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/listSerie/annees/1950">Années 1950</a></li>
                <li><a class="dropdown-item" href="/listSerie/annees/1960">Années 1960</a></li>
                <li><a class="dropdown-item" href="/listSerie/annees/1970">Années 1970</a></li>
                <li><a class="dropdown-item" href="/listSerie/annees/1980">Années 1980</a></li>
                <li><a class="dropdown-item" href="/listSerie/annees/1990">Années 1990</a></li>
                <li><a class="dropdown-item" href="/listSerie/annees/2000">Années 2000</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/listSerie/annees/all">1950-2009</a></li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/search/person">Acteurs</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
              <?php if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) : ?>
                <li class="nav-item">
                  <a class="nav-link" href="/admin">Admin</a>
                </li>
              <?php else : ?>
                <li class="nav-item">
                  <a class="nav-link" href="/contact">Contact</a>
                </li>
              <?php endif ?>
              <!-- <li class="nav-item">
                <a class="nav-link" href="/users/profil">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/users/logout">Déconnexion</a>
              </li> -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="connexion" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Salut, <?= ucfirst($_SESSION['user']['pseudo']) ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/users/profil/<?= $_SESSION['user']['id'] ?>">Profil</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="/users/logout">Déconnexion</a></li>
                </ul>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="connexion" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Connexion/Inscription
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/users/register">Inscription</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="/users/login">Connexion</a></li>
                </ul>
              </li>

            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container">
    <?php if (!empty($_SESSION['error'])) : ?>
      <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
      </div>
    <?php endif ?>
    <?php if (!empty($_SESSION['message'])) : ?>
      <div class="alert alert-success" role="alert">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
      </div>
    <?php endif ?>
    <?= $content ?>
  </main>
  <footer>
    <p>© 2021 Willremi</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
  <script src="/js/scripts.js"></script>

</body>

</html>