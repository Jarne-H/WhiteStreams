<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

///include_once(__DIR__ . "./includes/nav.inc.php");
include_once("bootstrap.php");

// include_once("bootstrapsession_start();.php");

// session_start();

// $post = new Post();


    //wanneer op "Post submit" geduwd wordt
    if(!empty($_POST)) {
		try {


			// $filename = $_FILES['uploadfile'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			//$tags = $_POST['tags'];

			var_dump($title);
			var_dump($description);
			//var_dump($tags);
			//echo "oke!";
			//$_SESSION['email'];

			// $tags = $_POST['tags'];
			// $tags = explode(" ", $tags);
			$post = new Post();
			$post->setTitle($title);
			$post->setDescription($description);
			//$post->setTags($tags);
			$post->addPost();

    } catch (\Throwable $th) {
		//toont errors bij een lege description of image, of bij een fout filetype
		$error = $th->getMessage();
	}
	



}
$f = new Feed();
	$limit = 12;
	$feed = $f->loggedIn($limit);




?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Project plaatsen</title>
  <link rel="stylesheet" href="./CSS/styling.css">    
</head>
<body>
	<div id="header">
		<div class="logo"></div>
	</div>

	<div id="main">
		<!-- <h1>create More</h1> -->
        <h3>Plaats je project</h3>
		<div class="loginfb"></div>
		<div class="linel"></div>
		<div class="liner"></div>

		<!-- formulier -->
		
		<div id="form">
			<form action="" method="post" enctype="multipart/form-data">
			
			<!-- <div class="square"> Als men er op klikt dan kan men afbeeldingen toevoegen-->
			
			<!-- </div> -->
			<!-- <img src=" <?php echo 'images/'.$filename; ?> ">  -->


			<div class="fields">
				<div class="inputfields">
					<label for="title">Naam project</label>
					<input name="title" type="text" required/>
				</div>

				<!-- <img src="<?php echo "image/Artboard 11.png"?>" alt=""> -->

				<div class="inputfields">
					<label for="description">Beschrijving</label>
					<input name="description" type="text" required/>
				</div>

				<div id="files">
				<input name="uploadfile" type="file" id="upload-image" />
				<input name="uploadfile1" type="file" id="upload-image1" />
				<input name="uploadfile2" type="file" id="upload-image2" />
				</div>
				<a id="addfiles" href="#">Upload Images/videos</a>

				<div>
					<button type="submit" name="upload" id="btn">Uploaden</button>
				</div>
			</div>
			</form>
		</div>

		<div id="result">
		<?php foreach ($feed as $f) : ;?>
		<h1><?php echo $f['username'] ?></h1>
		<h2><?echo $f['title'] ?></h2>
	<p><?php echo $f['description']?></p>
	<?php if (!empty($f['thumbnail'])):?>
			<img src="<?php echo $f['thumbnail'] ?>" alt="<?php echo $f['thumbnail'] ?>">
		<?php endif;?>
		<?php if (!empty($f['afbeelding2'])):?>
		<img src="<?php echo $f['afbeelding2'] ?>" alt="<?php echo $f['afbeelding2'] ?>">
		<?php endif;?>
		<?php if (!empty($f['afbeelding3'])):?>
		<img src="<?php echo $f['afbeelding3'] ?>" alt="<?php echo $f['afbeelding3'] ?>">
		<?php endif;?>

		<?php endforeach;?>
		</div>
</div>
		<script src="./JS/app.js"></script>
</body>
</html>