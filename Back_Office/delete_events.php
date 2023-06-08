<?php
require_once '../includes/connexion_bdd.php';
$id = $_GET['id'];
$sqlState = $pdo->prepare('DELETE FROM events WHERE id=?');
$supprime = $sqlState->execute([$id]);
header('location: list_events.php');

?>