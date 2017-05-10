<?php
session_start();
error_reporting( error_reporting() & ~E_NOTICE);

# unpack session data

include('../CommonMethods.php');

// Confirm that the user is a student
if ($_SESSION['type'] != 'student') {
  header('Location: ../index.php');
}

$debug = false;
$COMMON = new Common($debug);
$id = $_SESSION['studentID'];
//$id = $_SESSION['data'][0];
//echo("STudent I: $id");
$fName = $_SESSION['data'][2];
$lName = $_SESSION['data'][1];
$apptID = $_SESSION['meeting_id'];
$sql = "SELECT COUNT(`index`) FROM meetings";
$rs = $COMMON->executeQuery($sql, $_SERVER["meetings"]);
$row = mysql_fetch_row($rs);

include("../assets/header.html");

echo("<title>Appointment SignUp</title>");

$numOfRows = $row[0];
//echo("Number of rows is $numOfRows");
echo("<br><br>");


if ($apptID!=0) {


  echo("<form>You currently have an active appointment. Click <a href=canDeleteAppointments.php>here</a> to cancel before making a new one.</form>");
} else {
    
//checks if date pass is the current date of the next date
function validDate($date) {
  $currDate = date("m/d/Y");

  if(strtotime($date) > strtotime($currDate)){
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

  echo("<form action='setAppointments.php' method='POST'>");

  #TEST
  echo("<div class='tooltip'>");
  echo("<span class='tooltiptext'><b>Note:</b> Group Advising Sessions are
				  added two weeks in advance of the
				  session date. Additional times may be
				  added more quickly if the CNMS 
				  Advising Staff observes an unusual
				  demand (maximum of one set of 
				  sessions per day). If no Group Sessions
				  appear in your search, do the following:<br>
				  1) Check the message you recieved
				  from CNMS Advising to verify that you
				  are eligible for Group Advising<br>
				  a) If you confirm that you are eligible
				  for Group Advising, please check back
				  routinely for additional session dates.<br>
				  b) If you are NOT eligible, follow
				  the instructionsin that message for
				  Individual Advising.</span>");


  echo("<table style='width:100%'>");
  echo("<tr>
<th></th>
<th>Date</th>
<th>Start Time</th>
<th>Room</th>
<th>Advisor</th>
</tr>");

  #loop for group advising
  echo("<caption><b>Group Advising:</b></caption>");
  for($i = 0; $i<=$numOfRows; $i++){
    #loop over the meetings
    $sql = "SELECT * FROM `meetings` WHERE `index` = $i AND `active`=1";
    $rs = $COMMON->executeQuery($sql, $_SERVER["meetings"]);
    $row = mysql_fetch_row($rs);
    $index = $row[0];
    $start_time =convertTime( $row[1]);
    $date = date_format(date_create($row[2]), 'm/d/Y');
    $room = $row[3];
    $advisor_last_name = $row[4];
    $current_number_students = $row[5];
    $max_number_students = $row[6];
    
      //checks if appointment date is valid
    if(validDate($date)){
    #get the meeting variables
    if ($current_number_students < $max_number_students){
      #if their is room in the meeting print out the information- this is only suppose to print the  group meetings
      if($max_number_students!=1){

	echo("<tr>
<td><input type='radio' name='meeting' value=$i required></td>
<td>$date</td>
<td>$start_time</td>
<td>$room</td>
<td>$advisor_last_name</td>
</tr>");
      }//ends if
    }//ends outer if
    }//ends valid date
  }//ends for
  echo("</table>");
  #TEST
  echo("</div>");

  echo("<div class='tooltip'>");
  echo("<span class='tooltiptext'><b>Note:</b> Individual Advising Sessions are	
				  added two weeks in advance of the 
				  session date. Additional times may be
				  added more quickly if the CNMS 
				  Advising Staff observes an unusual
				  demand (maximum of one set of 
				  sessions per day). If no Individual Sessions
				  appear in your search, do the following:<br>
				  1) Check the message you recieved
				  from CNMS Advising to verify that you
				  are eligible for Individual Advising<br>
				  a) If you confirm that you are eligible
				  for Individual Advising, please check back
				  routinely for additional session dates.<br>
				  b) If you are NOT eligible, follow
				  the instructionsin that message for
				  Group Advising.</span>");

  echo("<table style='width:100%'>");
  echo("<tr>
<th></th>
<th>Date</th>
<th>StartTime</th>
<th>Room</th>
<th>Advisor</th>
</tr>");

  echo("<br><br>");

  #loop for individual advising
  echo("<caption><b>Individual Advising:</b></caption>");
  for($i = 0; $i<=$numOfRows; $i++){
    #loop over the meetings
    $sql = "SELECT * FROM `meetings` WHERE `index` = $i AND `active`=1";
    $rs = $COMMON->executeQuery($sql, $_SERVER["meetings"]);
    $row = mysql_fetch_row($rs);
    $index = $row[0];
    $start_time =convertTime( $row[1]);
    $date = date_format(date_create($row[2]), 'm/d/Y');
    $room = $row[3];
    $advisor_last_name = $row[4];
    $current_number_students = $row[5];
    $max_number_students = $row[6];
    #get the meeting variables
if(validDate($date)){
     if ($current_number_students<$max_number_students){

#if their is room in the meeting print out the information if an individual meeting
      if($max_number_students==1){
	echo("<tr>
<td><input type='radio' name='meeting' value=$i required></td>
<td>$date</td>
<td>$start_time</td>
<td>$room</td>
<td>$advisor_last_name</td>

</tr>");
      }
    }
}//ends valid date if
  }
  echo("</table>");
  echo("</div>");
  echo("<br><input type='submit'>");
  echo("<a href='index.php' class='button'>Cancel</a><br></form>");
}

?>
