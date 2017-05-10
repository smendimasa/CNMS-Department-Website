<?php
/* 
File:	 viewAppt.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/13/16

         Mostly HTML page for advisers to access 3 different ways to view appointments/students. 
*/ 

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include("../assets/header.html");
?>

<title>View Appointments</title>

<form action='searchAppts.php' method='post' name='searchAppts'>
  <b>Search for an appointment:</b><br><br>
  <b>Date: </b><br>
  <input type='date' name='apptDate' required><br>
  <b>Time: </b><br>
  <input type='time' name='apptTime' required><br>
  <b>Advisor: </b><br>
  <input type='text' name='apptAdvisor' required><br><br>
  <input type='submit' value='Search'><br><br>
  
  <b>Or:</b><br>
  <a href="viewAllAppts.php">Print out all appointments</a><br>
  <a href="viewAllStudents.php">Print out all students who have signed up</a><br>

</form>


</body>
</html>