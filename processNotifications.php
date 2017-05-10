<?php
session_start();
$debug = false;
include('../CommonMethods.php');

$COMMON = new Common($debug);
$_SESSION['confirmedPass'] = false;
$_SESSION['apptExists'] = false;
$name = $_SESSION['first'];


if ($_POST['confirm'] == 'Clear Notifications') {
	header('Location: index.php');

	// Get meeting ID's for this advisor
	$last = $_SESSION['last'];
	$sql = "SELECT `index` FROM `meetings` WHERE `advisor_last_name`='$last'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	// Get any of the records with the advisor's meeting IDs in the 'notifications' table and delete them
	while ($meetingID = mysql_fetch_assoc($rs)) {
		$ID = $meetingID['index'];
		$sql = "DELETE FROM `notifications` WHERE `meetingID`='$ID'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
} else {
	header('Location: index.php');
}

?>
