<?php
session_start();

error_reporting(0);

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include("../assets/header.html");
?>

<title>Create New Advisor</title>

<!--Form that prompts user to enter in their data-->
<h1>Create New Advisor</h1>
<form action='processCreateAdvisor.php' method='post' name='createAdvisor'>

  <p1>First Name:</p1>
  <input type='text' size='25' maxlength='25' name='fname' required></br></br>

  <p1>Last Name:</p1>
  <input type='text' size='25' maxlength='25' name='lname' required></br></br>

  <p1>Username:</p1>
  <input type='text' size='25' maxlength='25' name='username' required></br></br>
  
  <p1>Password:</p1>
  <input type='password' size='25' maxlength='25' name='password' required></br></br>
  
  <p1>Confirm Password:</p1>
  <input type='password' size='25' maxlength='25' name='cPassword' required></br></br>

  <p1>Office Location:</p1>
  <input type='text' size='25' maxlength='25' name='office' required></br></br>
  
  <p1>Email:</p1>
  <input type='email' size='25' maxlength='50' name='email' required></br></br>
  
  <input type='submit' value='Create Advisor'>

</form>
  
</body>
</html>