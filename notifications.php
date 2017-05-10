<?php
session_start();
$debug = false;
include('../assets/header.html');
?>

<!-- Form to display the notification(s) -->
<h1>Notifications</h1>
<form style='width: 60%;' action='processNotifications.php' method='post' name='notifications'>
	<!-- Display the notification -->
	<p style='text-align: center; font-size: 16px; font-family: Georgia, serif;'><?php echo $_SESSION['finalNotif']; ?></p>
	
	<?php
		// If there are no new notifications, the button should say 'Go Back'
		if ($_SESSION['finalNotif'] == "You have no new notifications.") {
			echo("<input type='submit' name='confirm' value='Go Back'><br/>");
		// If there is a new notification, the button should say 'Clear Notifications'
		} else {
			echo("<input type='submit' name='confirm' value='Clear Notifications'><br/>");
		}
	?>

</form>