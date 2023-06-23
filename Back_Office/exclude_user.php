<?php
//connexion admin ?
include_once '../includes/connexion_bdd.php';

//isset get ['id']
//is_numeric get ['id']
if (!isset($_GET['idUser']) || !is_numeric($_GET['idUser'])) {
    header('location: User_management.php?message= User Id invalide');
    exit;
}

$q = 'DELETE FROM User WHERE idUser=:userId';
$req = $bdd->prepare($q);
$req->execute(['userId' => $_GET['idUser']]);
header('location: User_management.php?message=User ' . $_GET['idUser'] . ' supprimer');
exit;


?>