<?php
session_start();
$click = $_POST['next'];

switch ($click)
  {
  case "Sign Up For An Appointment":
    header('Location: searchAppointments.php');
    break;
  case "Cancel Your Appointment":
    header('Location: canDeleteAppointments.php');
    break;
  case "Edit Your Information":
    header('Location: editInfo.php');
    break;
  case "View Appointment":
    header('Location: viewAppointment.php');
    break;
  case "Logout":
    header('Location: logout.php');
    break;
  }
?>