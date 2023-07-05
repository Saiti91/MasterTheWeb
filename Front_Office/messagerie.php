<?php
session_start();
$link = "";
$script = "../JS/ConversationSearch.js";
$script2 = "../JS/displayMessage.js";
$titre = "Messagerie";
include '../includes/header_index.php';
include '../includes/connexion_check.php';
include '../includes/connexion_bdd.php';


if (isset($_POST['message']) && !empty($_POST['message'])) {
    $q = 'INSERT INTO Message (User_id_Sender, User_id_Reciever,Text) VALUES (?,?,?)';
    $req = $bdd->prepare($q);
    $req->execute([$_SESSION['user_id'], 1, $_POST['Message']]);

}
?>

<div class="container border border-secondary mt-5">
    <div style="height: 500px" class="row">
        <div class="ps-5 p-3 col-4 border-end" id="conversations" style="overflow-y: scroll; overflow-x: hidden">
            <table class="table table-striped-columns text-center">
                <thead>
                <div class="row border-bottom pb-2  me-3">
                    <h2 class=" col-10 ">Conversation</h2>
                    <a class="col-1 btn btn-default btn-custom rounded-circle" href="#">+</a>
                </div>
                </thead>
                <tbody id="searchResultsConversation">
                <form action="">

                </form>
                </tbody>
            </table>
        </div>
        <div class="col-8 " id="messages">
            <div style="height: 76%; overflow-y: scroll">
                <table class="table table-striped-columns text-center">
                    <thead id="searchResultsConversationHead" s>

                    </thead>
                    <tbody id="searchResultsMessage">

                    </tbody>
                </table>
            </div>
            <div class="row p-2 g-3 align-items-center border-top">
                <div class="col-10 ">
                    <form id="myForm">
                        <div class="input-group">
                            <input type="text" id="messageInput" name="message"
                                   placeholder="Écrivez votre message ici..."
                                   required>
                        </div>
                </div>
                <div class="col-2">
                    <button class="btn btn-danger" type="submit">Envoye</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>