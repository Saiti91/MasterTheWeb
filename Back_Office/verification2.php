<?php
if (!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['mdp']) || empty($_POST['mdp']) || !isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['firstname']) || empty($_POST['firstname']) || !isset($_POST['Age']) || empty($_POST['Age'])) {

    header('location: ../Front_Office/inscription.php?message=You must fill all fields!');
    exit;
}


if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: ../Front_Office/inscription.php?message=Invalid Email');
    exit;
}

header('location: ../Front_Office/connexion.php');
exit;
    