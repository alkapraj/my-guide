<?php
//<img src="$img" width="75%" align="middle"></img>
require_once 'sanitize.php';
require_once 'checksession.php';
require_once 'logindata.php';

$conn = new mysqli($hn,$un,$pw,$db);
	
if($conn->connect_error) die("Connection cannot be established");

$cardid=null;

if(isset($_GET['value']))	$cardid = sanitizeString($_GET['value']);

// Get The CardTypes available
$query_str		= "SELECT * FROM giftcard WHERE cardID='$cardid'";
$result_card	= $conn->query($query_str);
if(!$result_card) die("Error Executing Query");
$row 				= $result_card->fetch_array(MYSQLI_ASSOC);
$cardname 		= $row['cardName'];
$value 			= $row['cardValue'];
$points 			= $row['points'];
$img 				= $row['image_path'];

echo <<<_END
<html>
<!-- -->
<!-- HEAD -->
	<head>	
		<!-- Head tag contains the metadata defined by tags like title, meta, style, link, script. The METADATA is not Displayed -->
		<title>This is the title tag on browser tab</title>

		<!-- Link for linking ext style sheets -->
		<link rel="stylesheet" href="styling.css">
		<link rel="stylesheet" href="card-details.css">	
	</head>
	<!-- BODY -->
	<body id="displayGiftCard">
	
	<!-- Web Page Header -->	
		<div class="row header">
			<div class="column25"></div>
			<div class="column75"></div>
			<div class="cell">
				<img src="Images/Logo.png" width="75%"></img></img>
			</div>			
			<div class="cell">
				<h1 >$cardname</h1>
			</div>					
			<a href="logout.php"><img style="float:right" src="Images/login_logo.jpg" width="10%"><a/>
		</div>			
		
	<!-- Web Page Content -->		
				<div class="content">
						<div class="column50"></div>
						<div class="column50"></div>
						<div class="row">
							<div class="cell50 center">
								<img src="$img" class="img"></img>
							</div>						
							<div class="cell50">
								<h2>$cardname</h2>
								<p>Reward Points: $points</p>  							<!-- To Do: Pick all display proerties from db later -->
								<p>Price: $value</p>  							<!-- To Do: Pick all display proerties from db later -->
								<p>Size: Free</p>  
								<p>Color: Pink</p>
								<p>Company: Disney</p>  
								<p>Strap Material: Leather</p>
								<p>Product Desciption: XYZ</p>
							</div>				
						</div>				
					
						<div class="row" >	
							<div class="column50"></div>
							<div class="column50"></div>
							<div class="row50" >								
								<div class="column16"></div>
								<div class="column16"></div>
								<div class="column16"></div>
								<div class="cell">				
									<form action="" method="POST">
										<input type="submit" name="update" value="Update Gift Card" class="button"/></a> 
									</form>
								</div>							
								<div class="cell">
									<form action="card-delete1.php" method="POST">
										<input type="hidden" name="cardid" value="$cardid" class="button"/>
										<input type="submit" name="delete" value="Delete Gift Card" class="button"/>							
									</form>
								</div>							
								<div class="cell">
									<form action="	" method="POST">
										<input type="submit" name="update" value="Redeem Gift Card" class="button"/> 				
									</form>
								</div>												
						</div>
					</div>
										
				</div>
	<!-- Web Page Footer -->
		<div class="footer"></div>
	</body>
</html>
_END;

?>