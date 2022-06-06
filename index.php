<?php 

	include_once("bootstrap.php");
$f = new feed();
$feed = $f->LoggedIn();




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			background:url("./images/stenen2.png");
			background-repeat: no-repeat;
			background-size: cover;
		
		}
		#blog {
			display: grid;
			grid-template-columns: repeat(3,1fr);
			max-width: 100%;
			position: relative;
			padding: 2em;
			opacity: 1;
		}
		#hide {
			display: none;
		}
		img {
			max-width: 40%;
		}
		 #blogpost {
			 margin-left: 2em;
		 }
		 #input {
			 margin-top: 10%;
			background-color: white;

		 }


	</style>
</head>
<body>	




<div id="input">
	<h1>Wat is er recent gebeurd in de gemeenschap?</h1>
<div id="blog">

		<?php foreach ($feed as $f) : ;?>
		<div id="blogpost">
		
	<?php if (!empty($f['thumbnail'])):?>
		<a href="postDetails.php?post=<?php  echo $f['id']; ?>"> 
		<img src="<?php echo $f['thumbnail'] ?>" alt="<?php echo $f['thumbnail'] ?>">
		<?php endif;?>
		<h2><?echo $f['title'] ?></h2>
	<p><?php echo $f['description']?></p>

		</div>
		
		<?php endforeach;?>
		</div>
		</div>
</body>
</html>