<?php


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

        
        $calendar.="<a class='btn btn-xs btn-primary'href='?month=".date('m',mktime(0,0,0,$month-1,1,$year))."&year=".date('Y',mktime(0,0,0,$month-1,1,$year))."'>Vorige Maand</a>";
        $calendar.="<a class='btn btn-xs btn-primary'href='?month=".date('m')."&year=".date('Y')."'>Huidige maand</a>";
        $calendar.="<a class='btn btn-xs btn-primary'href='?month=".date('m',mktime(0,0,0,$month+1,1,$year))."&year=".date('Y',mktime(0,0,0,$month+1,1,$year))."'>Volgende Maand</a></center><br>";


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
                $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Already Booked</button>";


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
 function showEvent() {

    $conn = new PDO('mysql:host=localhost;dbname=bybel', "root", "root");
    $statement = $conn->prepare("select event from calendar where MONTH(date)=? AND YEAR(date)=?");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);;

var_dump($result);






 }
 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            table {
                table-layout: fixed;
                max-width: 80%;
            }
            td {
                width:15%;
            }
            .today {

                background-color: yellow;
            }


    </style>
</head>
<body>
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
            echo showEvent();?>


            </div>


        </div>



    </div>
    
</body>
</html>