<?php
$link = "";
$titre = "Messagerie";
include '../includes/header_index.php';
//include '../includes/connexion_check.php';
include '../includes/connexion_bdd.php';


if (isset($_POST['message']) && !empty($_POST['message'])) {
    $q = 'INSERT INTO Message (User_id_Sender, User_id_Reciever,Text) VALUES (?,?,?)';
    $req = $bdd->prepare($q);
    $req->execute([$_SESSION['user_id'], 1, $_POST['Message']]);

}
?>

    <div class="container border border-secondary mt-5">
        <div style="height: 500px" class="row">
            <div class="ps-5 p-3 col-4 border-end" id="conversations">
                <div class="row border-bottom pb-2  me-3">
                    <h2 class=" col-10 ">Conversation</h2>
                    <a class="col-1 btn btn-default btn-custom rounded-circle" href="#">+</a>
                </div>
                <?php

                $q = 'SELECT * FROM Message GROUP BY User_id_Reciever ORDER BY User_id_Reciever AND date DESC'

                ?>
                <!--exemple de ligne de conversation-->
                <div class="row">
                    <!--image de profil-->
                    <div>
                        <!--    Pseudo-->
                        <!--    extrait de text du dernier message-->
                    </div>
                </div>
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
                                <textarea class="form-control" name="" id="inlineFormInputGroupUsername"
                                          rows="3" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-danger">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
//include '../includes/footer.php';
?>