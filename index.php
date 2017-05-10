<?php
session_start();

$_SESSION['userValue'] = false;

include("assets/header.html")
?>
<title>CNMS Advising Home</title>

<h1>Welcome to CNMS advising!</h1>


<a class="buttonSmall" style="background-color: #718CA3;" href="stuLogin.php">Student Login</a><br/>
<a class="buttonSmall" style="background-color: #718CA3;" href="advLogin.php">Advisor Login</a>


</body>
</html>
