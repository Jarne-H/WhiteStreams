<?php
    include_once(__DIR__ . "./Classes/User.php");

    //sessie starten

    session_start();
	session_destroy();

    if (!empty($_POST)) {
    	try {
			//er is gepost
        	User::login($_POST['email'], $_POST['password'], $_POST['name']);
    	} 
		catch (Exception $e) {
            $error = $e->getMessage();

        }
    }


	include_once("./header.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log in</title>
    <link rel="stylesheet" href="./CSS/styling.css">
</head>
<body>
<div id="header">
		<div class="logo"></div>
	</div>
	<main>
		<div class="loginfb"></div>
		<div class="linel"></div>
		<div class="liner"></div>

		<!-- formulier -->
		<div id="form">
			<form action="" method="post">
				<div>
				<div class="inputfields">
                    <label for="email">E-mail adres</label>
                    <input name="email" placeholder="E-mail adres" type="email" required/>
                </div>

				<div class="inputfields">
					<label for ="name">Naam</label>
					<input name="name" type="text" placeholder="naam" required>
				</div>

                <div class="inputfields">
                    <label for="password">Wachtwoord</label>
                    <input name="password" placeholder="Wachtwoord" type="password" required/>
                </div>
				<p id="wwvergeten">Wachtwoord vergeten? <a href="./requestcode.php">Klik hier!</a></p>
				</div>
				<?php if(isset($error)): ?>
				<div class="errorMessage">
					<p>
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>


				<div>
				<input type="submit" value="Meld je aan" id="btn">
				</div>

				<p id="hebaccount">Heb je nog geen account? <a href="./signUp.php">Meld aan</a></p>

			</form>
		</div>
	</main>
</body>
</html>