<?php
session_start();
$user = $_SESSION['email'];
$office = $_SESSION['office'];
date_default_timezone_set('EST');
$today = date("Y-m-d", strtotime('+2 day'));

error_reporting(0);

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include("../assets/header.html")
?>

<title>Edit Appointments</title>

<form action='processAppts.php' method='post' name='formEdit'>

<b>Appointment Date:</b><br>
<input type='date' name='apptDate' value='<?php echo $today; ?>' min='<?php echo $today; ?>' required><br><br>

<b>Appointment Time:</b><br>
<input type='time' name='apptTime' required><br><br>

<b>Appointment Location:</b><br>
<input type='text' name='apptLoc' required><br><br>

<b>Maximum number of students, up to 40 (enter 1 for individual appointment)</b><br>
<input type='number' name='apptMaxStudents' min='1' max='40' required><br><br>

<input type='submit' value='Save Appointment'>
</form>

<?php
if($_SESSION['apptExists'] == true) {
  echo("<form><p1>Appointment already exists.</p1></form>");
	$_SESSION['apptExists'] = false;
} 
?>

</body>
</html>
