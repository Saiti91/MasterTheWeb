<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link type="text/css" href="<?php echo $link ?>" rel="stylesheet">

    <title><?php echo $titre ?></title>
</head>
<body data-bs-theme="dark">
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Front_Office/index.php">HolowMusic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $titre == 'User Management' ? 'active' : ''; ?>"
                           href="User_Management.php">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $titre == 'Products' ? 'active' : ''; ?>"
                           href="product_list.php">Products
                            List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $titre == 'Events' ? 'active' : ''; ?>" href="list_events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $titre == 'Sells Management' ? 'active' : ''; ?>"
                           href="Sell_Sheet.php">Sells
                            Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $titre == 'Article Management' ? 'active' : ''; ?>"
                           href="gestion_artcl.php">Article Management
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>