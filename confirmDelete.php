<?php
session_start();
error_reporting( error_reporting() & ~E_NOTICE);

# unpack session data
$umbcID = $_SESSION['umbc_ID'];
$meetID = $_SESSION['meeting_id'];
$studentID = $_SESSION['studentID'];
$id = $_SESSION['advisorID'];

# set the apptID in the database to null
include('../CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

//update meeting
$sql = "UPDATE `meetings` SET `current_number_students` = `current_number_students`-1 WHERE `index` = '$meetID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["meetings"]);

$sql= "UPDATE `students_basic_info` SET `meeting_id`= '0' WHERE `umbc_ID`='$umbcID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["students_basic_info"]);


#updates 'data' value
$sql =  "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbcID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["students_basic_info"]);
$row = mysql_fetch_row($rs);
$_SESSION['data'] = $row;

//update meeting id
//$_SESSION['meeting_id']=0;

//add info to notification table
echo("Student ID $studentID Meeting id: $meetID");
$sql = "INSERT INTO notifications (`index`, `studentID`, `meetingID`) VALUES ('', '$studentID', '$meetID')";
$rs = $COMMON->executeQuery($sql, $_SERVER["notifications"]);

$_SESSION['meeting_id']=0;

#redirects to student home
header("Location: index.php");


?>