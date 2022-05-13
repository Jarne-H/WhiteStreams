<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include_once("bootstrap.php");
    //Connectie met de databank
    
    $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
    //Maak connectie met de databank

    if (session_status() == PHP_SESSION_NONE || session_id() == "" ) {
        session_start();
        
    }
    $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
  
    $statement = $conn->prepare("select * from user where email = :email");
    $statement->bindValue(":email", $_SESSION['email']);

    $result = $statement->execute();
   


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
    <main>
        <?php if (isset($_SESSION["email"])): ?>
            <form action="post">

                <input type="file" placeholder="image" name ="image">
                <input type="text" placeholder="name" name="name" value= <?php echo $_SESSION["name"]?>>
                <input type="email" placeholder="email" name="email" value = <?php echo $_SESSION["email"]?>>
                <input type="password" name="password" value = <?php echo $_SESSION["password"]?>>
            </form>
        <?php endif;?>
    </main>
    
</body>
</html>