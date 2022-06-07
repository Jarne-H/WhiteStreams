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
    <title>Contact</title>
    <link rel="stylesheet" href="./CSS/styling.css">
</head>
<body style="background-image: url(./assets/backgrounds/zon.png); background-image: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%,rgba(255,255,255,0.2) 100%), url(./assets/backgrounds/zon.png);">
    <main>
        <h1>Contacteer ons</h1>
        <div id="contactall">
            <div id="secretaryinfo">
                <img src="./assets/secretariaat.jpg" alt="secretariaat" id="secretariaatfoto">
                <div id="contactinformation">
                    <p>Email: st.lambertus.beerse@parochies.kerknet.be</p>
                    <p>Telefoon nummer: 014 613681</p>
                </div>
            </div>
            <form action="sendmail">

            </form>
        </div>
        <div class="lowerbackground" style="background-image: url(./assets/backgrounds/zon.png); background-image: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%,rgba(255,255,255,0.2) 100%), url(./assets/backgrounds/zon.png); background-position: 0% 80%;"></div>
        <div class="footer" style="background-color: #8E7F57;"></div>
    </main>
</body>
</html>