<?php
session_start();
$link = "";
$script = "../JS/message.js";
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
                    <tr>
                        <td><a href="">
                                <div class="row pt-3">
                                    <div class="col-md-2 text-center">
                                        <!--exemple de ligne de conversation-->
                                        <!--image de profil-->
                                    </div>
                                    <div class="col-md-7 ">
                                        <p class="text-center conversationName"></p>
                                    </div>
                                </div>
                            </a></td>
                    </tr>
                    </tbody>
                </table>
                <!-- fin exemple de ligne de conversation-->
            </div>
            <div class="col-8 " id="messages">
                <div style="height: 76%">
                    <?php


                    ?>
                </div>
                <form method="post" action="" class="align-bottom">
                    <div class="row p-2 g-3 align-items-center border-top">
                        <div class="col-10 ">
                            <div class="input-group">
                                <textarea class="form-control" name="" id="messageInput"
                                          rows="3" placeholder="Saisissez votre message"></textarea>
                            </div>
                        </div>
                        <div class="col-2">
                            <button id="sendButton" class="btn btn-danger">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
//include '../includes/footer.php';
?>