<?php
/* 
File:	 index.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/5/16

         Student Home Page
*/ 

session_start();
//$id = $_SESSION['studentID'];
//$umbcID = $_SESSION['data'][0];
//echo("STudent ID: $id");

// Confirm that the user is a student
if ($_SESSION['type'] != 'student') {
  header('Location: ../index.php');
}

//will be use when I edit this page a bit - sam
$name = $_SESSION['first'];




include("../assets/header.html")
?>
<title>Student Home</title>
<h1>Welcome, <?php echo "$name";?></h1>

<form action='processStuHome.php' method='post' name='advisorHome'>

      <input type='submit' name='next' value='Sign Up For An Appointment'><br/>
        <input type='submit' name='next' value='View Appointment'><br/>
      <input type='submit' name='next' value='Cancel Your Appointment'><br/>
      <input type='submit' name='next' value='Edit Your Information'><br/>
      <input type='submit' name='next' value='Logout'><br/>
    
    </form>

  </body>
</html>