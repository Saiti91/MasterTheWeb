<?php
if (!isset($_SESSION['Status']) || $_SESSION['Status'] != 2 || empty($_SESSION['Status'])) {
    header('location: ../Front_Office/index.php');
    exit;
}
?>