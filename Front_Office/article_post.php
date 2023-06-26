<?php
session_start();
require_once '../includes/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Rediriger l'utilisateur s'il n'est pas connecté vers la page de connexion pour qu'il puisse poster son article
    header('Location: connexion.php?message=You must log in to your account in order to post your article!');
    exit;
}

require 'C:\MAMP\htdocs\Projet Annuel\MasterTheWeb\PHP_Mailer\src\Exception.php';
require 'C:\MAMP\htdocs\Projet Annuel\MasterTheWeb\PHP_Mailer\src\PHPMailer.php';
require 'C:\MAMP\htdocs\Projet Annuel\MasterTheWeb\PHP_Mailer\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['title']) && isset($_POST['body']) && isset($_FILES['image'])) {
    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        $title = trim($_POST['title']);
        $title = htmlspecialchars($title);
        $body = trim($_POST['body']);
        $body = htmlspecialchars($body);
        $userId = $_SESSION['user_id'];

        $category = $_POST['category'];

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $erreur = $_FILES['image']['error'];

        if ($erreur === 0) {
            $maxSize = 2 * 1024 * 1024;
            if ($img_size > $maxSize) {
                $error = "Sorry, your file is too large.";
                header("Location: article_post.php?error=" . urlencode($error));
                exit;
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png", "gif");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                } else {
                    $error = "You can't upload files of this type";
                    header("Location: article_post.php?error=" . urlencode($error));
                    exit;
                }
            }
        } else {

            $error = "Error uploading the file.";
            header("Location: article_post.php?error=" . urlencode($error));
            exit;
        }


        $articleInsertQuery = 'INSERT INTO Article (title, body, image,User_id, Category_id ) VALUES (?, ?, ?, ?, ? )';
        $articleInsertStmt = $bdd->prepare($articleInsertQuery);
        $articleInsertStmt->execute(array($title, $body, $new_img_name, $userId, $category));

        // Récupérer la liste des abonnés à la newsletter
        $newsletterQuery = 'SELECT User.email FROM Newsletter JOIN User ON User.idUser = Newsletter.User_idUser';
        $newsletterStmt = $bdd->prepare($newsletterQuery);
        $newsletterStmt->execute();
        $subscribers = $newsletterStmt->fetchAll(PDO::FETCH_COLUMN);

        if ($subscribers) {
            // Envoyer la newsletter à tous les abonnés
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'patate.O2switch.net';
                $mail->SMTPAuth = true;
                if ($mail->SMTPAuth) {
                    $mail->SMTPSecure = 'ssl';
                    $mail->Username = 'derradji.ines@bessah.com';
                    $mail->Password = 'P@ssword2023';
                }
                $mail->Port = 465;

                $mail->setFrom('derradji.ines@bessah.com', 'HOLOMUSIC');

                foreach ($subscribers as $subscriber) {
                    $email = strval($subscriber);
                    $mail->addAddress($email);
                }

                $mail->isHTML(true);
                $mail->Subject = 'New article published!';
                $mail->Body = ' Dear subscriber,<br>
                We are excited to share that a new article has just been published !!! <br>
                Stay informed and inspired by visiting our website and checking out the new article today!
                ';

                $mail->AltBody = 'News';

                $mail->send();
            } catch (Exception $e) {
                // Gérer les erreurs d'envoi de l'e-mail
            }
        }
        $message = 'Your article has been successfully posted!';
    } else {
        $error = 'You must fill all fields!';
    }
}

?>

<?php
$link = "../CSS/Style_article_post.css";
$titre = "Article Publication";
include '../includes/header_index.php';

?>
<div class="article_container">
    <h1 class="d-flex justify-content-between my-4">Create New Topic</h1>

    <form action="article_post.php" method="POST" enctype="multipart/form-data">
        <div class="form_element my-4">
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>

        <div class="form_element my-4">
            <textarea type="text" class="form-control" name="body" placeholder="Content"></textarea>
        </div>

        <div class="form_element my-4">
            <label for="catego" style="color: white">Category</label>
            <select name="category" id="catego" class="form-select custom-select">
                <?php
                $q = 'Select * From Category';
                $req = $bdd->prepare($q);
                $req->execute([]);
                $donnee = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($donnee as $Index => $Value) {
                    echo '<option value="' . $donnee[$Value]['id'] . '">' . $donnee[$Value]['name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form_element my-4 ">
            <input class="form-control" type="file" name="image">
        </div>
        <div class="form_element d-flex justify-content-center">
            <input type="submit" value="Add article" class="btn btn-custom  mx-3 ">

        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
</script>
<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo '<div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">' . $error . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
} elseif (isset($error)) {
    echo '<div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">' . $error . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>



<?php
if (isset($message)) {
    echo '<div class="alert alert-success custom-alert  alert-dismissible fade show" role="alert">' . $message . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>

<?php
include('../includes/footer.php');
?>
</body>
</html>
