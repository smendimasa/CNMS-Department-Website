<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['email'] = ($_POST['email']);
$_SESSION['password'] = ($_POST['password']);
//prob want to delete this v
$_SESSION['userValue'] = false;

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$encrypted_pass = md5($password);

$sql = "SELECT * FROM `students_basic_info` WHERE `email` = '$email' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($row)
  {
    $studentID = $row['0'];
    $last = $row['1'];
    $first = $row['2'];
    $umbc_ID = $row['4'];
    $email = $row['5'];
    $meetingID=$row['8'];
    $_SESSION['studentID'] = $studentID;
    $_SESSION['last'] = $last;
    $_SESSION['first'] = $first;
    $_SESSION['umbc_ID'] = $umbc_ID;
    $_SESSION['email'] = $email;
    $_SESSION['meeting_id'] = $meetingID;
    //echo("Meeting ID: $first $meetingID ");
    // States that this account is a student, allowing it to access student pages
    $_SESSION['type'] = 'student';
    header('Location: studentSide/index.php');
  }
else
  {
    $_SESSION['userValue'] = true;
    $message = "Username and/or Password incorrect.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
  }

?>