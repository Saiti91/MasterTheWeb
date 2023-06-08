<?php
require_once '../includes/connexion_bdd.php';
$id = $_GET['id'];
$sqlState = $bdd->prepare('DELETE FROM Event WHERE id=?');
$supprime = $sqlState->execute([$id]);
header('location: list_events.php');

?>