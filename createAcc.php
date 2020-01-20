<?php
require_once 'logindata.php';
require_once "sanitize.php";
require_once "createAccValidation.php";
require_once 'logindata.php';

$conn = new mysqli($hn,$un,$pw,$db);
	
if (isset($_POST['username']))
{
	$username 		= 	sanitizeMySql($conn,$_POST['username']);
	$email 			= 	sanitizeMySql($conn,$_POST['email']);
	$firstname 		= 	sanitizeMySql($conn,$_POST['firstname']);
	$lastname 		= 	sanitizeMySql($conn,$_POST['lastname']);
	$password1 	= 	sanitizeMySql($conn,$_POST['password1']);
	$password2 	= 	sanitizeMySql($conn,$_POST['password2']);	
	$fail  		 		= 	validate_username($username);
	$fail  		 		= 	validate_email($email);
	$fail  		 		= 	validate_firstname($firstname);
	$fail  		 		= 	validate_lastname($lastname);
	$fail  				.= validate_password1($password1);
	$fail  				.= validate_password2($password2);
	$fail  				.= compare_password($password1,$password2);
		
	if ($fail == ""){
		echo "Form data validated successfully<br>";
	}else{
		echo $fail.'<br>';
		exit;
	}
}else{
	echo("Technical Error");
	exit;
}

	//hash password
	$salt1 = '*a)b';
	$salt2 = 'f^qz?';
	$token = hash('ripemd128',"$salt1$password1$salt2");
	echo $username,$email,$token,$firstname,$lastname;
	if($conn->connect_error) die("Error establishing connection");
	// Feed data to User db 	
	$query_str 				= "INSERT INTO users (username,email,password,firstname,lastname) VALUES ('$username','$email','$token','$firstname','$lastname')";
	$result                  	= $conn->query($query_str);

	if(!$result) die("Error Creating Account. Try Again!!");
	else {
		echo "Account Created Successfully. Click <a href='loginPage.php'>here</a> to login.";
		//header("Location: loginPage.php");
	}
	//$result->close();
	$conn->close();
	
?>