<?php
require_once 'logindata2.php';
require_once 'sanitize.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

class User{
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	
	function __construct($username){
		$this->username = $username;
		global $conn;
		
		$query ="SELECT * from users where username='$username'";
		$result = $conn->query($query);

		if(!$result) die($conn->error);	
	
		$rows = $result->num_rows;
		
		for($j=0; $j<$rows; $j++)
		{
			$result->data_seek($j); 
			$row 			= $result->fetch_array(MYSQLI_ASSOC);
			$this->password 	= $row['password'];
			$this->firstname 	= $row['firstname'];
			$this->lastname  	= $row['lastname'];
		}		
	}
	
	function get_password(){
		return $this->password;
	}
	function get_fullname(){
		return $this->firstname." ".$this->lastname;
	}	
}

?>