<?php
/* 
File:	 setInfo.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/5/16

         This php file retrieves all data entered by the student on Edit Information page (editInfo.php) 
         and updates the student_basic_info if the student entered any new values into the form. 
         
         It redirects back to the editInfo page so the student can see their newly made changes. 
*/ 

session_start();

include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$id = $_SESSION['studentID'];

// Get information from HTML form 
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$nickname = $_POST['nickname'];
$umbcID = $_POST['umbc_ID'];
$email = $_POST['email'];
$password = $_POST['password'];
$major = $_POST['major'];
$plans = $_POST['plans'];
$questions = $_POST['questions'];

// Only update password if they entered something (default is blank)
if ($password != '') {
    $password = md5($password);
    
    $sql = "UPDATE `students_basic_info` SET `password`='$password' WHERE `id`='$id'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

// Update information in databases
//UPDATE  `students_advising_info` SET  `post_plans` =  'What',`adv_questions` =  'Why' WHERE  `id` =  '16'
$sql = "UPDATE `students_basic_info` SET `fname`='$fname', `lname`='$lname', `nickname`='$nickname', `umbc_ID`='$umbcID', `email`='$email', `major`='$major' WHERE `id`='$id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$sql = "UPDATE `students_advising_info` SET `post_plans`='$plans', `adv_questions`='$questions' WHERE `id`='$id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: editInfo.php');
?>