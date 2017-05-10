<?php
/* 
File:	 viewAllAppts.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/11/16

         This php file retrieves all appointments created and all of the students_basic_info`
         who have signed up for them. It prints it out in a nice table format for the CNMS
         department to post in their office. 
*/

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include('../CommonMethods.php');
echo("<title>View All Appointments</title>");

$debug = false;
$COMMON = new Common($debug);

$sql = "SELECT * FROM `meetings` WHERE `active`=1 ORDER BY `date`, `start_time`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

date_default_timezone_set('America/New_York');

echo("
    <a class=\"buttonSmall\" href=\"viewAppts.php\">Back</a><br>
      <table border=\"1\">
        <tr>
          <th align=\"left\">Date</th>
          <th align=\"left\">Start Time</th>
          <th align=\"left\">Room</th>
          <th align=\"left\">Advisor</th>
          <th align=\"left\">Type</th>
          <th align=\"left\">Students</th>
        </tr>
");

while ($row = mysql_fetch_assoc($rs)) {
    $id = $row['index'];
    $date = date_create($row['date']);
    $start_time = convertTime($row['start_time']);
    $room = $row['room'];
    $adviser = $row['advisor_last_name'];
    $numStu = $row['current_number_students'];
    
    if ($row['max_number_students'] == 1) {
        $type = "Individual";
    }
    else {
        $type = "Group";
    }
    
    echo("<tr><td>");
    echo(date_format($date, 'm/d/Y'));
    echo("</td>
      <td>$start_time</td>
      <td>$room</td>
      <td>$adviser</td>
      <td>$type</td>
    ");
    
    if ($numStu > 0) {  
        $sql = "SELECT * FROM `students_basic_info` WHERE `meeting_id`='$id'";
        $rs2 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
        
        echo("<td>");
        
        while ($row2 = mysql_fetch_assoc($rs2)) {
            $fname = $row2['fname'];
            $lname = $row2['lname'];
            $umbcID = $row2['umbc_ID'];
            
            echo("$fname $lname, $umbcID");
            
            $numStu--;
            
            if ($numStu) {
                echo("<br>");
            }
        }
        
        echo("</td>");
    }
    
    echo("</tr>");
}

echo("</table>");


// convertTime converts a string in the format HH:MM:SS
// 		to a string in the format HH:MM AM/PM
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
?> 