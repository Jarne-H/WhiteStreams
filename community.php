<?php 
//Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript
include_once("bootstrap.php");
include_once("./header.php");

//controleer of er een update wordt verzonden
if(!empty($_POST))
{
	try {
		$Message = new Message();
		$Message->setText($_POST['message']);
		$Message->Save();
	} catch (\Throwable $th) {
		//throw $th;
	}
}
else {
	echo "Het is leeg";
}
//altijd alle laatste activiteiten ophalen
$Messages = Message::getAll();
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Online gemeenschap</title>
	<link rel="stylesheet" href="./CSS/styling.css">
</head>
<body>
<div>
	<div class="errors"></div>
	
	<form method="post" action="">
		<div class="statusupdates">

		<input type="text" placeholder="What's on your mind?" id="comment" name="message" />
		<input id="btnSubmit" type="submit" value="Add comment" />
		
		<ul id="listupdates">

		<?php 
			foreach($Messages as $m) {
					echo "<li>". $m->getText() ."</li>";
			}

		?>
		</ul>
		
		</div>
	</form>
	
</div>	



</body>
<script src="/JS/Script.js"></script>
</html>