<?php
	session_start();

	if($_SESSION['usertype'] == '' || $_SESSION['usertype'] == '4' || $_SESSION['usertype'] == '3')
	{
		header("location: login.php"); 
	}
?>