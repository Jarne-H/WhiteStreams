<?php

include_once("./header.php");

 function build_calendar($month, $year) {

    $mysqli = new mysqli('localhost', 'root','root','bybel');
    $stmt = $mysqli->prepare("select * from calendar where MONTH(date)=? AND YEAR(date)=?");
    //var_dump($stmt);

    $stmt->bind_param('ss',$month,$year);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $bookings[] = $row['date'];
            }
            $stmt->close();

        }
        
    }
        //array of all the days in a week
        $daysOfWeek = array("Zondag", "Maandag","Dinsdag","Woensdag","Donderdag","Vrijdag","Zaterdag");
        //First day of the month in the argument of the function
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        //Number of days of a month contains 
        $numbersOfDays = date('t', $firstDayOfMonth);

        //getting some information about first day of this month
        $dateComponents = getdate($firstDayOfMonth);

        //Name of this month
        $monthName = $dateComponents['month'];
        //Getting index value 0-6 of the first day of this month

        $dayOfWeek = $dateComponents['wday'];

        //Getting current date
        $dateToday = date('Y-m-d');
        //Create HTML table
        $calendar  = "<table class='table table-bordered'>";
        $calendar .= "<center><h2>$monthName $year </h2>";

        
        $calendar.="<a id= vorigeMaand class='btn btn-xs btn-primary'href='?month=".date('m',mktime(0,0,0,$month-1,1,$year))."&year=".date('Y',mktime(0,0,0,$month-1,1,$year))."'><img id= left src=lArrow.png </img></a>";
        $calendar.="<a id= huidigeMaand class='btn btn-xs btn-primary'href='?month=".date('m')."&year=".date('Y')."'>Huidige maand</a>";
        $calendar.="<a id= VolgendeMaand class='btn btn-xs btn-primary'href='?month=".date('m',mktime(0,0,0,$month+1,1,$year))."&year=".date('Y',mktime(0,0,0,$month+1,1,$year))."'><img id= right src=rArrow.png </img></a></center><br>";


        $calendar .= "<tr>";

        //Calendar headers
        foreach($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";

        }
        $calendar .= "</tr><tr>";

        //$dayOfWeek will make sure there are only 7 columns on our table

        if($dayOfWeek > 0 ) {
            for($k = 0;$k<$dayOfWeek;$k++) {
                $calendar.="<td></td>";
            }
        }
        //day counter
        $currentDay = 1;
        //Month number
        $month = str_pad($month,2,"0",STR_PAD_LEFT);

        while($currentDay <= $numbersOfDays) {

            //if seventh column is reached, start new row
            if ($dayOfWeek ==7) {$dayOfWeek = 0;$calendar .= "</tr><tr>";}

            $currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";

    


            $dayName = strtolower(date('i',strtotime($date)));
            $eventNum = 0;
            $today = $date ==date('Y-m-d')? "today":"";
            if ($date<date('Y-m-d')) {
                $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>N/A</button>";

            }
            elseif(in_array($date,$bookings)){
                $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Evenement is al gepland</button>";
                


            } else {
                $calendar.= "<td class='$today'><h4>$currentDay</h4><a href='book.php?date=".$date."'class='btn btn-success btn-xs'>Book</a>";
            }

            $calendar .= "</td>";

            //Counters
            $currentDay ++;
            $dayOfWeek ++;


        }
        //Completing row of last month

        if($dayOfWeek !=7) {
            $remainingDays = 7-$dayOfWeek;
            for($i=0;$i<$remainingDays;$i++) {
                $calendar .= "<td></td>";
            }
        }
        $calendar .= "</tr>";
        $calendar .= "</table>";

        echo $calendar;

 }

 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <nav>
    <a href="">Dis</a>
    <a href="">is</a>
    <a href="">de</a>
    <a href="">nav</a>


    </nav>
    <style>
        nav {
            background-color: lightyellow;
            padding: 1em;
        }
        body {
            background-image:url("manzon.png");
            background-repeat: no-repeat;
            background-size: 100%;
            background-position:top;
        }
        .container {
            background-color: white;
            position: relative;
            margin-top: 40%;
            padding-top: 2em;
            
        }
            table {
                table-layout: fixed;
                max-width: 80%;
                margin-left: 7em;
                margin-top: 0%;
                padding: 2em;

                
            }
            td {
                width:15%;
                border: solid 2px grey;
            }
            .today {

                background-color: yellow;
            }
            #vorigeMaand  {
                position: relative;
                text-decoration: none;
                left: -10%;
            }
            #VolgendeMaand {
                position: relative;
                text-decoration: none;
                right: -10%;
            }
            footer {
                padding:10%;
                background-image: url("manzon.png");
                background-repeat: no-repeat;
                background-position: bottom;
                background-size: 100%;
            }
            #info {
                background-color: #3B3939;
            }
           
          #huidigeMaand {
              display: none;
              text-decoration: none;


          }
          #left {
              width: 3%;
              position: relative;
              left: -20%;
          }
          #right {
              width: 3%;
              position: relative;
              right: -20%;
          }
    </style>
</head>
<body>
    <h2>Wat staat er op de planning?</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php $dateComponents = getDate();
            if(isset($_GET['month']) && isset($_GET['year'])){
                $month = $_GET['month']; 			     
                $year = $_GET['year'];
                 }else{
                $month = $dateComponents['mon']; 			     
                $year = $dateComponents['year'];
                }
            
            echo build_calendar($month, $year);
            ?>


            </div>


        </div>



    </div>
    <footer>
                <div id="info">
            <h2>WhiteStreams</h2>
            </div>
    </footer>
    
</body>
</html>