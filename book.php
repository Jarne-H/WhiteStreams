<?php 
include_once("bootstrap.php");
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
    }
    if (isset($_POST['submit'])) {
        $nameEvent = $_POST['event'];
       
        $description = $_POST['eventDescription'];
        $start = $_POST['eventStart'];
        $end = $_POST['eventEnd'];

        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO `calendar` ( `event`, `start`, `end`, `description`, `date`, `timeslot`) VALUES ( :event, :start, :end, , :description, :date)");
        $statement->bindValue(":event",$nameEvent);
        $statement->bindValue(":start",$start);
        $statement->bindValue(":end",$end);
        $statement->bindValue(":date", $date);
        /*$statement->bindValue(":eventType",$zondag);
        $statement->bindValue(":eventType2",$kerstmis);
        $statement->bindValue(":eventType3",$lang);
        $statement->bindValue(":eventType4",$andere);*/
        $statement->bindValue(":description",$description);
       

        $statement->execute();

        $message = "<div class='alert alert-success'>Booking succesvol </div>";
        



    }
    




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
    <div class="container">
    <h1 class="text-center">Book de datum: <?php echo date('d/m/Y',strtotime($date)) ;?></h1><hr>
    <div class="row"    >
    <div class="col-md-6 col-md-offset-3">
    <?php echo isset($message)?$message:'';?>
    <form action="" method="post" autocomplete="off">
        <div class="form_group">
        <label for="">Naam evenement</label>
        <input type="text" class="form-control" name="event">


        </div>
        <div class="form_group">
        <label for="">Tijdstart</label>
        <input type="time" class="form-control" name="eventStart">
        </div>
        <div class="form_group">
        <label for="">Tijdstop</label>
        <input type="time" class="form-control" name="eventEnd">
        </div>


        <div class="form_group">
        <label for="">Beschrijving</label>
        <input type="text" class="form-control" name="eventDescription">
        </div>
        <input type="submit" value="Book" class="btn btn-primary btn-fill " name="submit">


    </form>

    </div>

    </div>
    </div>
</body>
</html>