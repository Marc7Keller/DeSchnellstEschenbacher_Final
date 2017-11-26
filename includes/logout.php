<form name="logout_form" action="" method="POST">
	<input type="submit" name="logout_button" id="logout_button" value="Abmelden"/>
</form>

<?php
	if(isset($_POST['logout_button']))
	{
		unset($_SESSION['usertype']);
		unset($_SESSION['event']);
		$_SESSION = array();
		session_destroy();
		
		header('location: login.php');
	}
?>