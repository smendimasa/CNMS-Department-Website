<?php
session_start();
include('CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$first = $_SESSION['newFirst'];
$last = $_SESSION['newLast'];
$nickname = $_SESSION['newNickname'];
$umbc_ID = $_SESSION['newUmbcID'];
$pass = $_SESSION['newPass'];
$encrypted_pass = md5($pass);
$email = $_SESSION['newEmail'];
$major = $_SESSION['newMajor'];
$_SESSION['studentExists'] = false;

# Check to see if student already exists
$sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID' AND `lname` = '$last' AND `fname` = '$first'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
if($row)
  {
    $_SESSION['studentExists'] = true;
    header('Location: stuRegister.php');
  }
else
  {
# Set up Insert query to insert info into student basic info table
    $sql = "INSERT INTO `students_basic_info`(`id`, `lname`, `fname`, `nickname`, `umbc_ID`, `email`, `password`, `major`, `meeting_id`)" . " VALUES ('', '$last', '$first', '$nickname', '$umbc_ID', '$email', '$encrypted_pass', '$major', 0)";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    
    // Find newly created id and store it for later use
    $sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);

    $_SESSION['studentID'] = $row[0];
    $_SESSION['first'] = $first;
    //$_SESSION['type'] = 'student';
    header('Location: stuQuestions.php');
  }
?>