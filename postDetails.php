<?php
include_once("bootstrap.php");
$key = $_GET['post'];
$post = new feed();
$feed = $post::getPostById($key);

$allComments = comment::showComment($key);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Hallo</h2>
    
    <div>
        <h2><?php echo $feed['username'] ?></h2>
        <img src="<?php echo $feed['thumbnail']?>" alt="">
        <?php if (!empty($feed['afbeelding2'])) :?>
        <img src="<?php echo $feed['afbeelding2']?>" alt="">
        <?php endif ?>

        <?php if (!empty($feed['afbeelding3'])) :?>
        <img src="<?php echo $feed['afbeelding3']?>" alt="">
        <?php endif ?>

        <h2><?php echo htmlspecialchars($feed['title'])?></h2>
        <p><?php echo htmlspecialchars ($feed['description']) ?></p>



    </div>
    
    <form action="" method="post">
        <input id="textComment" name="comment" placeholder="Comment text" type="text" required contenteditable="99"/>
        <input id="submitComment" type="submit" value="plaats comment" data-postId="<?php echo $key ?>" data-username = "<?php echo "Jeffrey" ?>">
    </form>
    <ul class="commentList">
    <?php foreach($allComments as $c):  ?>
    <li>  <?php echo  $c['username'] ." ". $c['comment'] ?></li>
    <?php endforeach;?>
     </ul>

     <script src="./JS/Script.js"></script>

</body>
</html>
