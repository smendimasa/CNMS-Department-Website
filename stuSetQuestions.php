<?php
/* 
File:	 setQuestions.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/5/16

         This php files receives the two answers to the advising questions asked of students
         in questions.php and creates an new entry in students_advising_info.
         
         It redirects to the parent home page. 
*/ 

session_start();
include('CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$id = $_SESSION['studentID'];

// Get answers from HTML form
$plans = $_POST['plans'];
$questions = $_POST['questions'];

// Insert into database
$sql = "INSERT INTO `students_advising_info`(`id`, `post_plans`, `adv_questions`)" . " VALUES ('$id', '$plans', '$questions')";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: index.php');

?>