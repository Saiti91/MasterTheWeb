<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo $titre ?></title>
    <link rel="shortcut icon" href="../asset/Logotab.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="<?php echo $script ?>" type="text/javascript" defer></script>

    <link rel="stylesheet" type="text/css" href="../CSS/style_index.css"/>
    <link rel="stylesheet" type="text/css" href="../CSS/style_footer.css.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $link ?>"/>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid text-center">
            <a class="navbar-brand  px-3 mb-2" href="index.php">
                <img class="" src="../asset/Logo.svg"
                     width="50px"
                     height="50px"
                     alt="logo">
            </a>
            <p class="fw-bold fs-3 mt-3 text-center">HOLOWMUSIC</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php
                    if (isset($_SESSION['Status']) && $_SESSION['Status'] == 2) {
                        echo '<a class=" nav-link px-3" href="../Back_Office/User_Management.php">Back Office</a>';
                    }
                    echo '<a class=" nav-link px-3  ' . ($titre == 'Acceuil' ? 'active' : '') . '" href="../Front_Office/index.php">Home</a>
                    <a class=" nav-link px-3  ' . ($titre == 'Profil' ? 'active' : '') . '" href="../Front_Office/profil.php">Profil</a>
                    <a class=" nav-link px-3  ' . ($titre == 'Articles' ? 'active' : '') . '" href="../Front_Office/read_article.php">Articles</a>
                    <a class=" nav-link px-3  ' . ($titre == 'Shop' ? 'active' : '') . '" href="#">Shop</a>
                        <a class="btn btn-danger px-3"';
                    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
                        echo 'href="../Front_Office/connexion.php">Login';
                    } else {
                        echo 'href="../Front_Office/deconnexion.php">Deconnexion';
                    }


                    echo '</a>
                    </li>';
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>