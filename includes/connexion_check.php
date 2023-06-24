<?php
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: ../Front_Office/index.php');
    exit;
}
?>