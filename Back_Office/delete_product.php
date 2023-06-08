<?php
require_once '../includes/connexion_bdd.php';
$id = $_GET['id'];
$sqlState = $pdo->prepare('DELETE FROM products WHERE id=?');
$supprime = $sqlState->execute([$id]);
header('location: product_list.php');

?>