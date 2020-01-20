<?php
require_once "sanitize.php";

//validation functions	
function validate_username($string){
	return emptyField($string,'Username');
}
function validate_email($string){
	return emptyField($string,'Email');
}
function validate_lastname($string){
	return emptyField($string,'Lastname');
}
function validate_firstname($string){
	return emptyField($string,'Firstname');
}
function validate_password1($string){
	return emptyField($string,'Password');
}
function validate_password2($string){
	return emptyField($string,'Confirm Password');
}
function compare_password($pass1, $pass2){
	if($pass1==$pass2) return "";
	else return "Your Passwords do not match\n";
}
function emptyField($string,$fieldtext){
	return ($string == "") ? "No $fieldtext was entered.\n" : "";
}
?>