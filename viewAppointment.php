<?php
session_start();
error_reporting( error_reporting() & ~E_NOTICE);

// Confirm that the user is a student
if ($_SESSION['type'] != 'student') {
  header('Location: ../index.php');
}

# unpack session data

include('../CommonMethods.php');
include("../assets/header.html");
echo("<title>View Appointment</title>");
$debug = false;
$COMMON = new Common($debug);

$meetID= $_SESSION['meeting_id'];


//checks if date pass is the current date of the next date
function validDate($date) {
  $currDate = date("m/d/Y");

  if(strtotime($currDate)<=strtotime($date) ){
    //echo("true <br>");
    return true;
  }
  else{
    //echo("false <br>");
    return false;
  }
}

  // converTime converts a string in the format HH:MM:SS
  //         to a string in the format HH:MM AM/PM
  function convertTime($time) {
    $hours = intval($time[0] . $time[1]);
    $minutes = $time[3] . $time[4];
   
    // 12:00 PM
    if ($hours == 12) {
      $period = "PM";
    }
    // 12:00 AM
    else if ($hours == 24) {
      $hours = $hours - 12;
      $period = "AM";
    }
    // PM
    else if ($hours > 12) {
      $hours = $hours - 12;
      $period = "PM";
    }
    // AM
    else {
      $period = "AM";
    }
   
    return($hours . ":" . $minutes . " " . $period);
  }

if ($meetID!=0) {
    
}
echo("<form>");

 # print appt data if they have one, otherwise tell them they don't have one
    if ($meetID==0) {
        echo("You do not currently have an advising appointment. <br>
        Click <a href='searchAppointments.php'>here</a> to make one");
    } else {
        
  #sql code to retrieve appt info with $apptID from database
  $sql = "SELECT * FROM `meetings` WHERE `index`= '$meetID'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["meetings"]);
  $row = mysql_fetch_row($rs);

  # save data from sql query

  $startTime = convertTime( $row[1]);
  $date = date_format(date_create($row[2]), 'm/d/Y');
  $room = $row[3];
  $advisor = $row[4];
if(validDate($date)){
  echo("Your current advising appointment is on $date, at $startTime in room $room with $advisor");
  echo("<br>Click <a href='canDeleteAppointments.php'>here</a> to cancel current appointment");
    }
else{
    $_SESSION['meeting_id']=0;
  echo("Your appointment date has expire ! <br> Click <a href='searchAppointments.php'>here</a> to make a new appointment !");
}
    //if(validDate($date)==true)
      //  echo("<br>This is a Valid Date");
}
echo("</form>")

?>