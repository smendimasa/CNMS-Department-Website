<?php
/* 
File:	 viewAllStudents.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/11/16

         This php file retrieves all students who have signed up for an appointment.
         It prints their name, email, and umbc id in a nice printable table for the 
         CNMS department to know which students to email about signing up. 
*/

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include('../CommonMethods.php');
echo("<title>View All Students</title>");

$debug = false;
$COMMON = new Common($debug);

$sql = "SELECT * FROM `students_basic_info` WHERE `meeting_id`!=0 ORDER BY `lname`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

echo("
    <a class=\"buttonSmall\" href=\"viewAppts.php\">Back</a><br>
      <table border=\"1\">
        <tr>
          <th align=\"left\">Name</th>
          <th align=\"left\">Email</th>
          <th align=\"left\">UMBC ID</th>
        </tr>
");

while ($row = mysql_fetch_assoc($rs)) {
    $meetingID = $row['meeting_id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $umbcID = $row['umbc_ID'];
    $email = $row['email'];
    
    // Only print students who are signed up for an active meeting
    $sql2 = "SELECT * FROM `meetings` WHERE `index`='$meetingID'";
    $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
    $row2 = mysql_fetch_assoc($rs2);
    
    if ($row2['active'] == 1) {
        echo("<tr>
          <td>$lname, $fname</td>
          <td>$email</td>
          <td>$umbcID</td>
          </tr>
        ");
    }

}

echo("</table>");

?> 