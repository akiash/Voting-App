<?php 
	session_start();
	unset($_SESSION['ADMIN_LOGIN']);
	unset($_SESSION['ADMIN_USERNAME']);
		header('Location:login_voters.php');
		die();
?>