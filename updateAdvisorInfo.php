<?php
session_start();
include('../CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

//Get information from the form
$first = $_POST['fname'];
$last = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$office = $_POST['office'];
$email = $_POST['email'];
$advisorID = $_SESSION['advisorID'];

//Update session info for everything EXCEPT the password
$_SESSION['first'] = $first;
$_SESSION['last'] = $last;
$_SESSION['username'] = $username;
$_SESSION['office'] = $office;
$_SESSION['email'] = $email;
$_SESSION['confirmedPass'] = false;
$_SESSION['advisorExists'] = false;

//Only update password if something was entered
if ($password != '') {
	$password = md5($password);
	
	//Now update password in database
	$sql = "UPDATE `advisor_info` SET `password`='$password' WHERE `id`='$advisorID'";
    	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

//Update everything else
$sql = "UPDATE `advisor_info` SET `username` = '$username', `lname` = '$last', `fname` = '$first', `office` = '$office', `email` = '$email' WHERE `id` = '$advisorID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: infoEdited.php');

?>