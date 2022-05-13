<?php
include_once(__DIR__ . "/classes/User.php");
include_once("./header.php");
require "librariess\phpmail\PHPMailer\PHPMailerAutoload.php";

session_start();
session_destroy();


//connectie met databank

if (!empty($_POST)) {
        $email = $_POST['email'];
        User::requestResetCode($email);
        header("./index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./CSS/styling.css">
    <title>Password Reset</title>
</head>

<body>
    <div id="header">
        <div class="logo"></div>
    </div>
    <main>
        <div class="loginfb"></div>
        <div class="linel"></div>
        <div class="liner"></div>

        <div id="form">
            <form method="post" action="">

                <div class="inputfields">
                    <label for="email">Email</label>
                    <input name="email" placeholder="Email" type="text" required />
                </div>

                <?php if (isset($errorEmail)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorEmail ?></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input class="btn" type="submit" value="Request code">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="./signUp.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>