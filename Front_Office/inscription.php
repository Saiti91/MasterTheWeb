<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style_inscription.css"/>
    <title>Sign up</title>


</head>
<body>


<main>


    <div class="box1">


        <div class="inner-box">

            <div class="formulaire">
                <form action="verification_inscriptions.php" method="POST" class="sign-up">


                    <div class="head1">
                        <h1>Sign up</h1>
                    </div>


                    <div class="actual-form">
                        <div class="input">
                            <input type="text" name="username" placeholder="Username" class="input-field">
                        </div>

                        <div class="input">
                            <input type="text" name="firstname" placeholder="Firstname" class="input-field">
                        </div>


                        <div class="input">
                            <input type="date" name="date_of_birth" placeholder="Date of birth" class="input-field">
                        </div>


                        <div class="input">
                            <input type="email" name="email" placeholder="Email" class="input-field">
                        </div>


                        <div class="input">
                            <input type="password" name="mdp" placeholder="Password" class="input-field">
                        </div>


                        <?php

                        if (isset($_GET['message']) && !empty($_GET['message'])) {
                            echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
                        }

                        ?>

                        <input type="submit" value="Sign in" class="sign-btn">


                    </div>
                </form>

            </div>


            <div class="sign-in">
                <h1>Already a member ?</h1>
                <a href="connexion.php" class="sign-in-btn">Sign in</a>
            </div>


        </div>
    </div>

</main>


</body>
</html>