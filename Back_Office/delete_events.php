<?php
  require_once 'include/database.php';
  $id = $_GET['id'];
  $sqlState = $pdo->prepare('DELETE FROM events WHERE id=?');
  $supprime = $sqlState->execute([$id]);
  header('location: list_events.php');

?>