<?php
/* 
File:	 turnOn.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/18/16

         Turns on all appointments after the date entered on turnOffConfirm.php.
         Prints out text confirming the turning on. 
*/ 

session_start();

// Confirm that the user is an advisor
if ($_SESSION['type'] != 'advisor') {
  header('Location: ../index.php');
}

include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$date = $_POST['turnonDate'];

$sql = "UPDATE `meetings` SET `active`=1 WHERE `date`>='$date'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

include("../assets/header.html");

echo("<form>All meetings after $date have been turned on!</b></form>");
?>