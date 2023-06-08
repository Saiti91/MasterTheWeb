<?php
try {
    $bdd = new PDO('mysql:host=51.178.30.38;port=3306;dbname=MasterTheWeb', 'esgi', 'password', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die($e->getMessage());
}
?>