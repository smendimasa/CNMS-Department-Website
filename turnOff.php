<?php
/* 
File:	 turnOff.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/18/16

         Turns ff all appointments in the meetings database.
         Prints out text confirming the turning off. 
*/ 

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$sql = "UPDATE `meetings` SET `active`=0";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

include("../assets/header.html");

echo("<form>All meetings have currently been set to inactive!<br>
            (If this was done in error, please go back to the Reset Site page and turn any appointments you still need back on.)</form>");
?>