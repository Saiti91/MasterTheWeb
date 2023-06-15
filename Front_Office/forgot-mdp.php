<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/Style_forgot.css"/>
    <title>Reset password</title>


</head>
<body>


<main>


    <div class="box1">


        <div class="inner-box">


            <div class="formulaire">
                <form action="verification-mdp.php" method="POST" class="sign-in">


                    <div class="head1">
                        <h1>Password reset</h1>
                        <p>Please enter your email so we can send you a new password.</p>
                    </div>


                    <div class="actual-form">
                        <div class="input">
                            <input type="email" name="email" placeholder="Email" class="input-field">
                        </div>


                        <input type="submit" value="Submit" class="sign-btn">

                        <div class="head1">
                            <?php
                            $successParam = htmlspecialchars($_GET['success'] ?? null);
                            if ($successParam === '1') {
                                echo 'Message has been sent';
                            } elseif ($successParam === '2') {
                                echo 'Mailer Error : Message could not be sent ';
                            }
                            ?>
                        </div>


                        <p class="text-help">
                            Back to
                            <a href="connexion.php">Login ?</a>
                        </p>


                    </div>
                </form>

            </div>
        </div>


</main>

</body>
</html>
