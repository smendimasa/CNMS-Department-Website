<?php
session_start();

include("assets/header.html");

$_SESSION['confirmedPass'] = false;
$_SESSION['studentExists'] = false;
?>

<title>Student Login</title>

    <h1>Please login</h1>
    <form action='stuProcessLogin.php' method='post' name='studentLogin'>
      Email: <input type='email' name='email' required><br/><br/>
      Password: <input type='password' name='password' required><br/><br/>
      <input type='submit' value='Login'>
    </form>

    <form action='stuRegister.php' method='post' name='registerStudent'>
        <input type='submit' value='New Student Registration'>
    </form>
  </body>
</html>
