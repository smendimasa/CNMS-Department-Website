<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['email'] = ($_POST['email']);
$_SESSION['password'] = ($_POST['password']);
//prob want to delete this v
$_SESSION['userValue'] = false;

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$encrypted_pass = md5($password);

$sql = "SELECT * FROM `advisor_info` WHERE `email` = '$email' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($row)
  {
    $advisorID = $row['0'];
    $last = $row['3'];
    $first = $row['4'];
    $office = $row['5'];
    $email = $row['6'];
    $_SESSION['advisorID'] = $advisorID;
    $_SESSION['last'] = $last;
    $_SESSION['first'] = $first;
    $_SESSION['office'] = $office;
    $_SESSION['email'] = $email;
    // States that this account is an advisor, allowing it to access advisor pages
    $_SESSION['type'] = 'advisor';
    header('Location: advisorSide/index.php');
  }
else
  {
    $_SESSION['userValue'] = true;
    $message = "Username and/or Password incorrect.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message');history.go(-1); </script>";
  }

?>