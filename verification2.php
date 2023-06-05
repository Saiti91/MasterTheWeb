<?php
if(!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['mdp']) || empty($_POST['mdp']) || !isset($_POST['username']) || empty($_POST['username'])|| !isset($_POST['firstname']) || empty($_POST['firstname'])  || !isset($_POST['Age']) || empty($_POST['Age'])){
           
    header('location: inscription.php?message=You must fill all fields!');
    exit;
}


if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    header('location: inscription.php?message=Invalid Email');
    exit;
}

header('location: connexion.php');
exit;
    