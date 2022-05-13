<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once(__DIR__ . "/classes/User.php");
include_once("./header.php");




if (!empty($_POST)) {
    $options = ['cost' => 14,];
    $email = $_POST['email'];
    $recievedcode = $_POST['recievedcode'];
    $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $passwordlength = strlen($_POST['password']);
    
    if (User::resetPassword($email, $recievedcode)) {
        if ($passwordlength >= 6) {
            User::resetUserPassword($email, $newpassword);
        } else {
            $errorPass = "Wachtwoord moet minstens 6 characters lang zijn.";
        }
    } else {
        $errorWrongCode = "De resetcode was onjuist of vervallen.";
    }
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

                <div class="inputfields">
                    <label for="recievedcode">Reset code</label>
                    <input name="recievedcode" placeholder="Reset code" type="text" required />
                </div>

                <?php if (isset($errorWrongCode)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorWrongCode ?></p>
                    </div>
                <?php endif; ?>

                <div class="inputfields">
                    <label for="password">New password</label>
                    <input name="password" placeholder="New password" type="password" required />
                </div>

                <?php if (isset($errorPass)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorPass ?></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input class="btn" type="submit" value="Reset password">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="./signUp.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>