<?php

include_once(__DIR__ . "./Classes/User.php");

//Pagina verwijst door naar login

//Kijken of velden leeg zijn
//Als ze leeg zijn --> error true
//Connectie maken met database
// email moet op @thomasmore.be eindigen

if (!empty($_POST)) {
$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$passwordconf = $_POST['password_conf'];
		
//Als het wachtwoord hetzelfde is als passwordconf en als ze minstens 6 characters zijn dan wordt je ingelogd
		if (  $password === $passwordconf && strlen($password)>=6) {

				try {
				$user = new User();
				$user->setName($name);
				$user->setEmail($email);
				$user->setPassword($password);
				$user->SignUp();
				session_start();
				$_SESSION['email'] = $user->getEmail();
				$_SESSION['name'] = $user->getName();
				header("Location: login.php");
				}

				catch (Throwable $error) {
					$error = $error->getMessage();
					
				}
				/*catch (Throwable $errorUser) {
					$errorUser = $errorUser->getMessage();
				}*/
}
if ($password !== $passwordconf) {
	$error = "Wachtwoorden komen niet overeen";
}
if (strlen($password)<6) {
	$error = "Wachtwoorden moet minstens 6 karakters bevatten";
}




}

include_once("./header.php")
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bybel</title>
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
		<div id="form">
			<form method="post" action="">
		
				<div class="inputfields">
                    <label for="email">E-mail</label>
                    <input name="email" placeholder="E-mail adres" type="email" required autofocus/>
                </div>
				<?php if(isset($error)):?>
				<div class="errorMessage">
					<p><?php echo $error?></p>
				</div>
				<?php endif;?>

				<div class="inputfields">
                    <label for="name">Naam</label>
                    <input name="name" placeholder="Vul je naam in" type="text" required/>
                </div>
				
                <div class="inputfields">
                    <label for="password">Wachtwoord</label>
                    <input name="password" placeholder="Vul je wachtwoord in" type="password" required/>
                </div>
			
                <div class="inputfields">
                    <label for="password_conf">Wachtwoord bevestigen</label>
                    <input name="password_conf" placeholder="Bevestig je wachtwoord" type="password" required />
                </div>
			
				</div>
				
		
				<div>
				<input type="submit" value="Meld je aan" id="btn">
				</div>

				<p id="hebaccount">Heb je al een account? <a href="./logIn.php">Login in</a></p>


		</div>
		</form>


	
</body>
</html>