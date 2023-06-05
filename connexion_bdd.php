<?php 
try{
$bdd = new PDO('mysql:host=localhost;port=8889;dbname=master_theweb','root','root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e){
die($e->getMessage());
}
?>