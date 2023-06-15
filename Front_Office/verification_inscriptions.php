<?php

if (
    !isset($_POST['email']) || empty($_POST['email']) ||
    !isset($_POST['mdp-confirm']) || empty($_POST['mdp-confirm']) ||
    !isset($_POST['mdp']) || empty($_POST['mdp']) ||
    !isset($_POST['username']) || empty($_POST['username']) ||
    !isset($_POST['firstname']) || empty($_POST['firstname']) ||
    !isset($_POST['date_of_birth']) || empty($_POST['date_of_birth'])
) {
    header('location: ../Front_Office/inscription.php?message=You must fill all fields!');
    exit;
}


if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: ../Front_Office/inscription.php?message=Invalid Email');
    exit;
}


if (strlen($_POST['mdp']) < 6 || strlen($_POST['mdp']) > 20) {
    header('location: inscription.php?message=The password must be between 6 and 20 characters!');
    exit;
}
include '../includes/connexion_bdd.php';


$q = 'SELECT idUser,username,firstname,birthdate FROM User WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['email']]);
$results = $req->fetchAll();

if (!empty($results)) {

    header('location:inscription.php?message=Email already used !');
    exit;
}

$q = 'INSERT INTO User (username,firstname,birthdate,email,password,Status) VALUES(?,?,?,?,?,1)'; //Requete
$req = $bdd->prepare($q); //Préparation de la requete
$results = $req->execute([
    htmlspecialchars($_POST['username']),
    htmlspecialchars($_POST['firstname']),
    htmlspecialchars($_POST['date_of_birth']),
    htmlspecialchars($_POST['email']),
    hash('sha256', ($_POST['mdp']))
]);

if (!$results) {
    // rediraction avec message erreur
    header('location:inscription.php?message=Connexion error !');
    exit;
} else {
    header('location:connexion.php?message=account created successfully !');
    exit;
}
?>