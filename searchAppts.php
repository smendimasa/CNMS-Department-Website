<?php
/* 
File:	 searchAppt.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/13/16

         Searches for appointment entered on viewAppt.php. If found, prints out all info
         and all students signed up and their info. 
         If appointment is not found, prints out blurb about not being found. 
*/ 

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include('../CommonMethods.php');
echo("<title>Searched Appointment</title>
      <a class=\"buttonSmall\" href=\"viewAppts.php\">Back</a><br>");

$debug = false;
$COMMON = new Common($debug);

$date = $_POST['apptDate'];
$time = $_POST['apptTime'];
$advisor = $_POST['apptAdvisor'];

$sql = "SELECT * FROM `meetings` WHERE `date`='$date' AND `start_time`='$time' AND `advisor_last_name`='$advisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

// Print out meeting info if meeting found 
if ($row != NULL) {
    $id = $row['index'];
    $location = $row['room'];

    if ($row['max_number_students'] == 1) {
        $type = "Individual";
    }
    else {
        $type = "Group";
    }

    echo("<u>$type Appointment on $date $time with $advisor in $location</u><br><br>");
    
    $sql = "SELECT * FROM `students_basic_info` WHERE `meeting_id`='$id'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    
    // Print out all students in a meeting 
    while ($row = mysql_fetch_assoc($rs)) {
        $stuID = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $nickname = $row['nickname'];
        $umbcID = $row['umbc_ID'];
        $email = $row['email'];
        $major = $row['major'];
        
        $sql2 = "SELECT * FROM `students_advising_info` WHERE `id`='$stuID'";
        $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
        $row2 = mysql_fetch_assoc($rs2);
        
        $plans = $row2['post_plans'];
        $questions = $row2['adv_questions'];
        
        echo("$fname $lname<br>");
        if ($nickname != NULL) {
            echo("Preferred Name: $nickname<br>");
        }
        echo("UMBC ID: $umbcID<br>
              Email: $email<br>
              Major: $major<br>
              Post UMBC Plans:<br> $plans <br>
              Questions:<br> $questions <br>");
    }
}
// Else print out Appointment not found error_get_last
else {
    echo("Sorry, we couldn't find this appointment!");
}

?>

