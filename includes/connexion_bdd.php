<?php
try {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=masterthewebpa', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die($e->getMessage());
}
?>