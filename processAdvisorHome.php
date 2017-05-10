<?php
session_start();
$selectedOption = $_POST['next'];

switch ($selectedOption)
  {
  case "Create Appointments":
    header('Location: editAppts.php');
    break;
  case "View Appointments":
    header('Location: viewAppts.php');
    break;
  case "Edit Your Account Info":
    header('Location: editAdvisorInfo.php');
    break;
  case "Create New Advisor":
    header('Location: createAdvisor.php');
    break;
  case "Reset Site":
    header('Location: turnOffConfirm.php');
    break;
  case "Logout":
    header('Location: processLogout.php');
    break;
  }


?>