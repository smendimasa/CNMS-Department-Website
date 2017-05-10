<?php
session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

error_reporting(0);

include("../assets/header.html");
include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

// Using advisor's first name, pull their other information from the database
$first = $_SESSION['first'];
$sql = "SELECT * FROM `advisor_info` WHERE `fname` = '$first'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$username = $row[1];
$last = $row[3];
$office = $row[5];
$email = $row[6];

echo("
	<h1>Edit Information</h1>
	<form action='updateAdvisorInfo.php' method='post' name='UpdateProfile'>
  	<p1>First Name:</p1> <input type='text' size='25' maxlength='25' name='fname' value='$first'></br></br>
  	<p1>Last Name:</p1> <input type='text' size='25' maxlength='25' name='lname' value='$last'></br></br>
  	<p1>Username:</p1> <input type='text' size='25' maxlength='25' name='username' value='$username'></br></br>
	<p1>Password:</p1> <input type='password' size='25' maxlength='25' name='password' placeholder='Leave blank if you do not wish to change your password'></br></br>
  	<p1>Office Location:</p1> <input type='text' size='25' maxlength='25' name='office' value='$office'></br></br>
  	<p1>Email:</p1> <input type='email' size='25' maxlength='50' name='email' value='$email'></br></br>
  	<input type='submit' value='Update Profile'>
	</form>

</body>
</html>
");

?>