<?php
	session_start();

	if($_SESSION['usertype'] == '' || $_SESSION['usertype'] == '4')
	{
		header("location: login.php"); 
	}
?>