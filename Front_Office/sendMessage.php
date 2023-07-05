<?php
include '../includes/connexion_bdd.php';
if (isset($_POST['text']) || isset($_POST['Sender']) || isset($_POST['Reciever']) || isset($_POST['Conversation'])) {
    $text = $_POST['text'];
    $sender = $_POST['Sender'];
    $receiverName = $_POST['Reciever'];
    $conversation = $_POST['Conversation'];
} else {
    echo "La clé 'text' n'existe pas dans le tableau \$_POST.";
}
$query = $bdd->prepare("SELECT idUser FROM User WHERE username = :username");
$query->bindParam(':username', $receiverName);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $receiverId = $user['idUser'];
    $query = $bdd->prepare("INSERT INTO Message (text, User_id_Sender, User_id_Reciever, ConversationID) 
                                    VALUES (:text, :sender, :reciever, :conversation)");
    $query->bindParam('text', $text);
    $query->bindParam('sender', $sender);
    $query->bindParam('reciever', $receiverId);
    $query->bindParam('conversation', $conversation);
    $query->execute();
} else {
    echo "Aucun utilisateur correspondant trouvé.";
}
