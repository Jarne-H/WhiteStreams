<?php
include_once("./header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/styling.css">
</head>
<body style="background-image: url(./assets/backgrounds/stenen2.png); background-image: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%,rgba(255,255,255,0.2) 100%), url(./assets/backgrounds/stenen2.png);">
    <main>
        <div class="postlist">
            <?php foreach($posts as $p): ;?>
            <div class="post">
                <div class="imagecontainer">
                    <div class="postimage">
                    <img id="post-image" src=./assets/<?php echo $p['filename']?> alt="Foto"></div>
                </div>
                <h3>Paul en Marie zijn in het huwelijks boodje gestapt!</h3>
                <p>Proficiat Paul en Marie met het huwelijk, het was echt zo een mooie dag voor een huwelijk.</p>
            </div>

            <div id="feed-post">
                <img id="feed-image" src=./assets/<?php echo $f['filename']?> alt="Foto">
            <?php if (isset($_SESSION['email'])):?>
        <?php endif;?>
        </div>

            <?php endforeach;?>
        </div>
        <div class="lowerbackground" style="background-image: url(./assets/backgrounds/stenen2.png); background-image: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%,rgba(255,255,255,0.2) 100%), url(./assets/backgrounds/stenen2.png);  background-size: 100%;"></div>
        <div class="footer" style="background-color: #64626B;"></div>
    </main>
</body>
</html>