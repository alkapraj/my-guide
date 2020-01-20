<html>
	<head>	
		<!-- Head tag contains the metadata defined by tags like title, meta, style, link, script. The METADATA is not Displayed -->
		<title>Login Page </title>
		<!-- Link for linking ext style sheets -->
			<link rel="stylesheet" href="styling.css">
			<link rel="stylesheet" href="loginPage.css">
			<script src="commonValidations.js"></script>
			<script src="loginPageValidation.js"></script>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
	</head>
	<body>
			<div class="row">
				<div class="column33"></div><div class="column33"></div><div class="column33"></div>								
				<div class="cell"><img src="Images/Logo.png" 		width="50%" 	class="left"></img></div>				
				<div></div>
				<div></div>
				<!--<div class="cell"><img src="Images/login_logo.jpg" width="35%"	class="right"></img></div>		-->
			</div>						 
		
			<div class="row">
				<div class="column33"></div><div class="column33"></div><div class="column33"></div>				
				<div class="cell"></div>
				<!-- LOGIN FORM -->
					<div id="login" class="login item2">
						<div class="box">
						<h2 class="center">Login</h2>
						<form action="loginPageValidation.php" method="POST" onsubmit="return emptyFieldChk(this)">
							<label class="left">Username:</label>			<input name="username" 	type="text" 				value="Enter you mail id" 	class="right"/><br><br>
							<label class="left">Password:</label>	<input name="password" 	type="password" 	value="" 								class="right"/><br><br>
							<input name="linkClicked" 	type="hidden" 	value=""/><br><br>
							<!-- <a href="">Forgot Password?</a><br><br> -->
							<a id="createAcc"  href="createAcc.html">Create an Account</a><br><br>
							<!--<a id="continue" 	href="card-list.php">Continue as Guest</a><br><br> -->
							<!-- <a id="continue" 	href="" onselect="return a()">Continue as Guest</a><br><br>-->
							<input type="submit" value="Log in"/><br>
						</form>
						</div>
					</div>
					<div class="cell"></div>
			</div>			

<?php
require_once 'logindata.php';
require_once 'sanitize.php';
//require_once 'user.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) { 	
	$un_temp 	= sanitizeMySql($conn, $_POST['username']); 
	$pw_temp 	= sanitizeMySql($conn, $_POST['password']); 
	
	//get password from DB w/ SQL
	$query = "SELECT password FROM users WHERE username = '$un_temp'";	
	$result = $conn->query($query); 	
	if(!$result) die($conn->error);
	$rows = $result->num_rows;
	$correct_pw="";
	
	for($j=0; $j<$rows; $j++)
	{
		$result->data_seek($j); 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$correct_pw = $row['password'];
	}
	
	$salt1 		= '*a)b';
	$salt2 		= 'f^qz?';
	$token 	= hash('ripemd128',"$salt1$pw_temp$salt2");  
	
	if($token == $correct_pw){
		//$user = new User($un_temp);
		session_start();
		$_SESSION['username'] = $un_temp;	
		$_SESSION['password'] = $pw_temp; 		
		header("Location: card-list.php");
	}
	else
	{
		echo<<<_END
		<script>
				document.getElementById('msg').innerHTML = "Login Error. Try again."
		</script>
_END;
		}
	
}else{
	exit();
}
?>
			<script>
			function a(){
				document.getElementById('msg').innerHTML = "Login Error. Try again."					
					<?php 
					?>
			}
			</script>
	</body>	
</html>
