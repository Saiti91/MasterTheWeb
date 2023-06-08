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
<body class="bg-dark text-bg-dark">
<header class="bg-secondary">
    <h1>Back Office</h1>
    <nav class="navbar-nav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="Sell_Sheet.php">Sells Sheet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="User_Management.php">Users Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Articles Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="list_events.php">Events Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Comments Management</a>
            </li>

        </ul>
    </nav>
</header>