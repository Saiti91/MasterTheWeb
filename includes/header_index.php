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
    <link rel="stylesheet" type="text/css" href="<?php echo $link ?>"/>
</head>
<body>
<header>
    <nav>
        <div class="container-fluid">
            <ul>
                <div class="row">
                    <li class="col-1">
                        <a href="index.php">
                            <img class="" src="../asset/Logo.svg"
                                 width="50px"
                                 height="50px"
                                 alt="logo">
                        </a>
                    </li>
                    <li class="col-1 pt-3">
                        <p class="fw-bold fs-3 text-center">HOLOWMUSIC</p>
                    </li>

                    <?php
                    if (!isset($_SESSION['Status']) || empty($_SESSION['Status'])) {
                        echo '<li class="offset-5 col-1 pt-4 text-center">
                        <a href="../Front_Office/index.php">Home</a>
                    </li>';
                    } elseif ($_SESSION['Status'] == 1) {
                        echo '<li class="offset-5 col-1 pt-4 text-center">
                            <a href="../Front_Office/index.php">Home</a></li>';
                    } elseif ($_SESSION['Status'] == 2) {
                        echo '<li class="offset-4 col-1 pt-4">
                            <a href="../Back_Office/User_Management.php">Back Office</a></li>
                            <li class="col-1 pt-4 text-center">
                            <a href="../Front_Office/index.php">Home</a></li>';
                    }
                    ?>
                    <li class="col-1 pt-4 text-center">
                        <a href="#">Profil</a>
                    </li>
                    <li class="col-1 pt-4 text-center">
                        <a href="#">Articles</a>
                    </li>
                    <li class="col-1 pt-4 text-center">
                        <a href="#">Shop</a>
                    </li>
                    <li class="col-1 pt-3">
                        <a class="btn btn-danger" href="../Front_Office/connexion.php">
                            <?php
                            if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
                                echo 'Login';
                            } else {
                                echo 'Deconnexion';
                            }

                            ?>
                        </a>
                    </li>
                </div>
            </ul>

        </div>
    </nav>

    <?php
    //                $w = window.innerWidth;
    //            if(w < 650px)
    //            {
    //                    echo
    //                    '/*SVG*/';
    //
    //            }
    //            else
    //            {
    //                echo    '
    //                <a href="" id="hmenu"><strong>Home</strong></a>
    //                <a href="" id="hmenu"><strong>News</strong></a>
    //                <a href="" target="_blank" id="hmenu"><strong>Forum</strong></a>
    //                <a href="" target="_blank" id="hmenu"><strong>Shop</strong></a>
    //                <a href="" class="btn rounded-pill">Login</a> ';
    //            }
    ?>
</header>