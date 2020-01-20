<?php

	require_once 'sanitize.php';
	require_once 'user.php';
	
	$username 			= "";
	$fullname           = "" ;
	$login           		= "" ;
	$continue           	= "" ;
	
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: loginPage.php");
		exit();
	}	
	
	$login                  = sanitizeString($_SESSION['login']);
	$username 			= sanitizeString($_SESSION['username']);
	$user 					= new User($username);
	$fullname           = $user->get_fullname();
	
?>