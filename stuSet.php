<?php

session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['newLast'] = $_POST['lname'];
$_SESSION['newFirst'] = $_POST['fname'];
$_SESSION['newNickname'] = $_POST['nickname'];
$_SESSION['newUmbcID'] = $_POST['umbc_ID'];
$_SESSION['newPass'] = $_POST['password'];
$_SESSION['newMajor'] = $_POST['major'];
$_SESSION['newEmail']= $_POST['email'];
$encrypted_password = md5($_POST['password']);

$sql = "SELECT * FROM `students_basic_info` WHERE `lname` = '$_POST[lname]' AND `fname` = '$_POST[fname]' AND `umbc_ID` = '$_POST[umbc_ID]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);



# If passwords are not equal redirect them to the register page
if($_POST['password'] != $_POST['confirmPass'])
  {
    $message = "Passwords do not match.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='stuRegister.php';</script>";
    # header('Location: stuRegister.php');
  }
# If student already exists redirect them to the register page
elseif($row)
  {
    $message = "Student already exits.\\nLog in or register a new student.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='stuLogin.php';</script>";
    # header('Location: stuRegister.php');
  }
# If student selected "other" as major, redirect to "this isn't the website you're looking for" page
elseif($_POST['major'] == "other") {
    header('Location: studentSide/other.php');
}
# If passwords are equal create the student's account
elseif($_POST['password'] == $_POST['confirmPass'])
  {
   header('Location: stuCreate.php');
  }

?>
