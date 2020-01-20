<?php

session_start(); 

if(isset($_SESSION['username']))
{
	$_SESSION 	= array();
	$days 			= 24 * 60 * 60 * 31;
	setcookie('username', '', time() - $days, '/');		
	setcookie('continue', '', time() - $days, '/');		
	session_destroy();
	echo "user susccessfully logged out";
}

?>