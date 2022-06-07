<?php
include_once("./header.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/styling.css">
</head>
<body style="background-image: url(./assets/backgrounds/boom.png); background-image: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%,rgba(255,255,255,0.2) 100%), url(./assets/backgrounds/boom.png); background-position: 0% 50%;">
    <main>
<h1>Live viering</h1>
        <div class="iframeparent">
        <!--De livestream: -->
        <!-- --><iframe src="https://player.castr.com/live_22998970cb8111ec9b677fbec3710cf7" width="590" height="431" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
        
        
        <!--Tijdelijke content: -->
        
        <!--     <iframe src="https://www.youtube.com/embed/knZ4T7Qx-z0" width="590" height="431" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
        --></div>
        <div class="oudestreams">
            <div class="oudestream">
                <h2>Vorige viering</h2>
                <div class="iframeparent">
                    <iframe src="https://www.youtube.com/embed/knZ4T7Qx-z0" width="590" height="431" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                </div>
            </div>
            <div class="oudestream">
                <h2>2 weken geleden</h2>
                <div class="iframeparent">
                    <iframe src="https://www.youtube.com/embed/knZ4T7Qx-z0" width="590" height="431" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                </div>
            </div>
            <div class="oudestream">
                <h2>3 weken geleden</h2>
                <div class="iframeparent">
                    <iframe src="https://www.youtube.com/embed/knZ4T7Qx-z0" width="590" height="431" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="lowerbackground" style="background-image: url(./assets/backgrounds/boom.png); background-image: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%,rgba(255,255,255,0.2) 100%), url(./assets/backgrounds/boom.png);  background-position: 0% 80%"></div>
        <div class="footer" style="background-color: #4D301E;"></div>
    </main>
    <div id="chatslider">
        <div id="chat">
            <p class="livechat">De chat is nog leeg</p>
        </div>
        <div id='openchat'>
            <div id="chevron-arrow"></div>
        </div>
    </div>
</body>
<script type="text/javascript" src="./JS/openchat.js"></script>
</html>