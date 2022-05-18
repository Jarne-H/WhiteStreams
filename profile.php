<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include_once("bootstrap.php");
    //Connectie met de databank
    
    session_start();
    $myEmail = $_SESSION['email'];
    $result = [];
    $profile = new profile();

    $result = $profile->getInfo($myEmail);
   


//Haal gegevens uit de databank van de user
//Zet de gegevens in invoervelden




include_once("./header.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
	<link rel="stylesheet" href="./CSS/styling.css">
</head>
<body>
    
    <div>
    <form action="post">
        <?php foreach ($result as $r) : ;?>
    <input type="text" placeholder="name" name="name" value=<?php echo $r['name']?>>
    <input type="file" placeholder="image" name ="image" value = <?php echo $r['profilePicture']?>>
    <input type="email" placeholder="email" name="email" value = <?php echo $r['email']?>>
    <input type="password" name="password" value = <?php echo $_SESSION["password"]?>>
        <?php endforeach;?>
    </form>






    </div>
    
</body>
</html>