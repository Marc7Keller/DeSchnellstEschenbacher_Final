<?php
	session_start();

	if($_SESSION['usertype'] == '' || $_SESSION['usertype'] == '4' || $_SESSION['usertype'] == '5')
	{
		header("location: login.php"); 
	}
?>