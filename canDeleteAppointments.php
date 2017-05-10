<?php
session_start();
include('../CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

# unpack session data
$apptID = $_SESSION['meeting_id'];

//sql command
    $sql = "SELECT * FROM `meetings` WHERE `index` = $apptID";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);
    $index = $row[0];
    $start_time =convertTime( $row[1]);
    $date = date_format(date_create($row[2]), 'm/d/Y');
    $room = $row[3];
    $advisor_last_name = $row[4];
    $current_number_students = $row[5];
    $max_number_students = $row[6];

//checks if date pass is the current date of the next date
function validDate($date) {
  $currDate = date("m/d/Y");

  if(strtotime($date) == strtotime($currDate)){
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

// Confirm that the user is a student
if ($_SESSION['type'] != 'student') {
  header('Location: ../index.php');
}

include("../assets/header.html");
echo("<title>Confirm Delete</title>");


echo("<br><br>");
# ensure student has an appt before letting them cancel
echo("<form>");
if ($apptID==0) {
  echo("You do not have an appointment to cancel.");
} else {
    
    
    if(validDate($date)){
        echo("You cannot cancel an appointment that is within 24 hours !. Please email your advisor, if this is an emergency !");
    }
    else{
    
  # confirm that student wishes to cancel their appt
  echo("Are you sure you wish to cancel your appointment?<br><br>");
  echo("<a href='confirmDelete.php' class='button'>Yes</a>
  <br><br> <a href='index.php' class = 'button'>No</a>");
    }
}

echo("</form>");
?>