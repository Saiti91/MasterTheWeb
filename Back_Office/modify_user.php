<?php
session_start();
include '../includes/connexion_check_admin.php';
$link = '../CSS/style_s.css';
$titre = 'Modify User Information';
include '../includes/header_backoffice.php';
include_once '../includes/connexion_bdd.php';

if (!isset($_GET['idUser']) || !is_numeric($_GET['idUser'])) {
    header('location: User_management.php?message= User Id invalide');
    exit;
}
$q = 'SELECT * FROM User WHERE idUser = :userId';
$req = $bdd->prepare($q);
$req->execute(['userId' => $_GET['idUser']]);
$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<div style="margin-top: 100px" class="container">
    <form action="verification_modif_user.php?idUser=<?= $_GET['idUser'] ?>" method="POST">
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">Username</label>
                <input type="text" class="form-control custom" name="username" value="<?= $donnees[0]['username'] ?>">
            </div>

            <div class="offset-1 col-4 pb-3">
                <label class="form">Name</label>
                <input type="text" class="form-control custom" name="name" value="<?= $donnees[0]['name'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">First Name</label>
                <input type="text" class="form-control custom" name="firstname" value="<?= $donnees[0]['firstname'] ?>">
            </div>

            <div class="offset-1 col-4 pb-3">
                <label class="form">Password</label>
                <input type="text" class="form-control custom" name="password">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">Email</label>
                <input type="text" class="form-control custom" name="email" value="<?= $donnees[0]['email'] ?>">
            </div>
            <div class="offset-1 col-4 pb-3">
                <label class="form">Status</label>
                <select class="form-select" name="date" id="buy_date">
                    <option value="User" <?= $donnees[0]['Status'] == '1' ? 'selected' : '' ?> >User</option>
                    <option value="Admin" <?= $donnees[0]['Status'] == '2' ? 'selected' : '' ?> >Admin</option>
                </select>
            </div>
        </div>
        <input type="submit" value="Modify" class="btn btn-custom offset-9  my-4">
    </form>
</div>
