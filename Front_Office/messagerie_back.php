<?php
include '../includes/connexion_bdd.php';
$q = 'SELECT DISTINCT u1.idUser AS sender_id,u1.username AS sender_username,     
                    u2.idUser AS reciever_id,u2.username AS reciever_username FROM Message m     
                    JOIN User u1 ON m.User_id_Sender = u1.idUser
                    JOIN User u2 ON m.User_id_Reciever = u2.idUser WHERE    
                    m.User_id_Sender = 10 OR m.User_id_Reciever = 10';
$req = $bdd->query($q);
//$req->execute([/*$_SESSION['user_id'], $_SESSION['user_id'], $_SESSION['user_id'], $_SESSION['user_id']*/]);
$donnee = $req->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($donnee);

