<?php
session_start();
error_reporting( error_reporting() & ~E_NOTICE);

//$meetID = $_POST['data'][8];
$meetID = $_POST['meeting'];
//$id = $_SESSION['studentID'];
//$umbcID = $_SESSION['data'][0];
$umbcID = $_SESSION['umbc_ID'];



include('../CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);
$sql= "UPDATE `students_basic_info` SET `meeting_id`='$meetID' WHERE `umbc_ID`='$umbcID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["students_basic_info"]);
$_SESSION['meeting_id']=$meetID;
#updates 'data' value
$sql =  "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbcID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["students_basic_info"]);
$row = mysql_fetch_row($rs);

$_SESSION['data'] = $row;

$sql = "UPDATE `meetings` 
SET current_number_students = current_number_students + 1 
WHERE `index` = $meetID";
$rs = $COMMON->executeQuery($sql, $_SERVER["meeting"]);
$id = $_SESSION['data'][0];
$sql = "UPDATE `students_basic_info` 
SET `meeting_id` = $meetID
WHERE `id` = $id";
$rs = $COMMON->executeQuery($sql, $_SERVER["student_basic_info"]);


#redirects to student home
header("Location: index.php");

?>