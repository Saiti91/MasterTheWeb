<?php
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('location: ../Front_Office/connexion.php');
    exit;
}
?>