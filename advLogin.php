<?php
session_start();
include("assets/header.html")
?>
<title>Advisor Login</title>
</head>
<body>
<h1>Please login</h1>
<form action='advProcessLogin.php' method='post' name='advisorLogin'>
  Email: <input type='email' name='email' required><br/><br/>
  Password: <input type='password' name='password' required><br/><br/>
  <input type='submit' value='Login'>
</form>
</body>
</html>