<?php
session_start();
var_dump($_POST);
include('../CommonMethods.php');

error_reporting(0);

$debug = false;
$COMMON = new Common($debug);

$date = $_POST['apptDate'];
$time = $_POST['apptTime'];
$room = $_POST['apptLoc'];
$maxStudents = $_POST['apptMaxStudents'];
$lastName = $_SESSION['last'];

$sql = "SELECT * FROM `meetings` WHERE `advisor_last_name` = '$lastName' AND `date` = '$date' AND `start_time` = '$time'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if ($row) {
	$_SESSION['apptExists'] = true;
	header('Location: editAppts.php');
} else {
  $sql = "INSERT INTO meetings (start_time, date, room, advisor_last_name, current_number_students, max_number_students) VALUES ('$time', '$date', '$room', '$lastName', 0, '$maxStudents')";

  $rs = $COMMON->executeQuery($sql, $_SERVER["meetings"]);
	header('Location: apptCreated.php');
    
}
?>