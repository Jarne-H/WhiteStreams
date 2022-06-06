<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

///include_once(__DIR__ . "./includes/nav.inc.php");
include_once("bootstrap.php");

// include_once("bootstrapsession_start();.php");

// session_start();

// $post = new Post();

	//$postId = $_GET['postId'];
    //wanneer op "Post submit" geduwd wordt
    if(!empty($_POST)) {
		try {

			$post= new Post();
			// $filename = $_FILES['uploadfile'];
			$title = $_POST['title'];
			$description = $_POST['description'];

		
			$post->setTitle($title);
			$post->setDescription($description);
			//$post->setTags($tags);
			$post->addPost();
			

    } catch (\Throwable $th) {
		//toont errors bij een lege description of image, of bij een fout filetype
		$error = $th->getMessage();
	}



}
//var_dump($_POST);

$f = new feed();
$limit = 12;
$feed = $f->notLoggedIn($limit);

	

		$comment = $_POST['commentText'];
		
		$c = new comment();
		$c->setUsername("jeffrey");
		$c->setComment($comment);
		//$c->setPostId($feed['id']);
		//var_dump($commentSection);


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
			
				
				</div>
				<a id="addFile" href="#">Upload Images/videos</a>
				
				<div>
					<button type="submit" name="upload" id="btn">Uploaden</button>
				</div>
			</div>
			</form>
		</div>
		<div class="feed">

<!-- In de div feed komen er images, titels, descriptions enz-->
			<?php foreach($feed as $f): ;?>
					<div id="feed-post">
						<h3><?php echo $f['username']?></h3>
						<a href="postDetails.php?post=<?php  echo $f['id']; ?>"> 
						<img id="feed-image" src="<?php echo htmlspecialchars($f['thumbnail'])?>" alt="Foto">
						<h2><?php echo $f['title']?></h2>
						<p><?php echo $f['description'] ?></p>
	</div>
<?php endforeach;?>

</div>
<script src="./JS/Script.js"></script>
</body>
</html>