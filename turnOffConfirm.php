<?php
/* 
File:	 turnOffConfirm.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/18/16

         Allows adviser to either turn off all appointments or turn on all appointments 
         after a certain date. Redirects to either turnOff.php or turnOn.php.
*/ 

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include("../assets/header.html");

?>

<title>Turn Off Advising</title>
<form action='turnOff.php' method='post' name='turnoff'>
    <b>Warning: Pressing this button will turn off all currently existing appointments.</b><br><br>
    <input type='submit' value='Turn Off'>
</form>
    
<form action='turnOn.php' method='post' name='turnon'>
    <b>Need to turn some appointments back on?<br>
    All appointments after the date entered below will be turned back on.</b><br>
    <input type='date' name='turnonDate' required><br><br>
    <input type='submit' value='Turn On'>

</form>


</body>
</html>