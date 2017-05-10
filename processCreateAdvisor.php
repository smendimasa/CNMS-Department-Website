<?php
session_start();
include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

error_reporting(0);

// Get information from the form
$first = $_POST['fname'];
$last = $_POST['lname'];
$username = $_POST['username'];
$office = $_POST['office'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cPassword'];
$encrypted_pass = md5($password);

//SQL code to determine whether the advisor already exists
$sql = "SELECT * FROM `advisor_info` WHERE `lname` = '$last' AND `fname` = '$first' AND `username` = '$username'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

// Check if passwords match
if ($password != $cpassword) {
   $message = "Passwords do not match.\\nTry again.";
   echo "<script type='text/javascript'>alert('$message');window.location.href='createAdvisor.php';</script>";
} else if ($row) {
	 $message = "Advisor already exits.\\nLog in or register a new advisor.";
   echo "<script type='text/javascript'>alert('$message');window.location.href='createAdvisor.php';</script>";
} else {
	$sql = "INSERT INTO `advisor_info`  (`username`, `password`, `lname`, `fname`, `office`, `email`)
	VALUES ('$username', '$encrypted_pass', '$last', '$first', '$office', '$email')";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	header('Location: advisorCreated.php');
}

?>