<?php

require_once 'sanitize.php';
require_once 'checksession.php';
require_once 'logindata.php';
$conn = new mysqli($hn,$un,$pw,$db);

$cardname=null;	
$cardtype=null;	
$cardvalue=null;	
$points=null;
$cardid=null;
			
if($conn->connect_error) 
{
	die("Connection cannot be established");
}

if(isset($_POST['cardid']))
{
	$cardid 		= sanitizeString($_POST['cardid']);	

	if(!empty($cardid))
	{	
		$query_str	= "SELECT * FROM giftcard WHERE cardId = $cardid";
		$result_card_detail			= $conn->query($query_str);
		
		if(!$result_card_detail)
		{	
			die("Error Executing Query");
		}
		else
		{
				for($j=0;$j<1;$j++)
				{
					$card_detail = $result_card_detail->fetch_array(MYSQLI_ASSOC);
					$cardname 	= $card_detail['cardName'];	
					$cardtype 	= $card_detail['cardType'];	
					$cardvalue 	= $card_detail['cardValue'];	
					$points 		= $card_detail['points'];
					$image_path = $card_detail['image_path'];
				}
		}
	}
}

echo <<<_END
<html>
<!-- -->
<!-- HEAD -->
	<head>
	
		<!-- Head tag contains the metadata defined by tags like title, meta, style, link, script. The METADATA is not Displayed -->
		<title>This is the title tag on browser tab</title>

		<!-- Link for linking ext style sheets -->
		<link rel="stylesheet" href="styling.css">
		<link rel="stylesheet" href="card-delete.css">
	
	</head>
<!-- BODY -->
	<body id="displayGiftCard">

	<!-- Web Page Header -->
		<div class="row header">
			<div class="column25">
				<img src="Images/Logo.png" width="75%"></img>
			</div>			
			<div class="column50">
				<h1>Delete Gift-Card</h1>
			</div>			
			<div class="column25">
			<a href="logout.php"><img style="float:right" src="Images/login_logo.jpg" width="10%"><a/>
			</div>			

		</div>			

	<!-- Web Page Content -->		
		
		<form action="card-del.php." method="POST">
			<div class="content">
				<div id="delete" class="row right">
						<input type="submit" name="deleteCard" value="DELETE" class="button"><br>
						<input type="hidden" name="cardid" value="$cardid">
				</div>
				<br>
				<div class="row" style="height:50%">
					<div class="column33">
						<fieldset>
								<img src="$image_path"></img>
						</fieldset>
					</div>
					
					<div class="column67">
						<fieldset id="fieldset1">
							<!-- <legend>Card Details</legend> -->
							<!-- Card ID -->			
							<div class="row75">
								<div class="column25">Card ID: </div>
								<div class="column50"><input type="text" name="cardID" size="30" maxlength="11" value="$cardid" readonly></div>
							</div>
							<!-- Card Name -->
							<div class="row75">
								<div class="column25">Card Name: </div>
								<div class="column50"><input type="text" name="cardName" size="30" maxlength="100" value="$cardname" readonly><br></div>
							</div>
							<!-- Card Type: -->
							<div class="row75">
								<div class="column25">Card Type: </div>
								<div class="column50"><input type="text" name="cardType" size="30" maxlength="100" value="$cardtype" readonly><br></div>
							</div>
							<!-- Card Value: -->
							<div class="row75">
								<div class="column25">Card Value: </div>
								<div class="column50"><input type="text" name="cardValue" size="30" maxlength="10" value="$cardvalue" readonly><br></div>
							</div>
							<!-- Reward Points: -->
							<div class="row75">
								<div class="column25">Reward Points: </div>
								<div class="column50"><input type="text" name="rewardPoints" size="30" maxlength="50" value="$points" readonly><br></div>			
							</div>
						</fieldset>			
					</div>	
				</div>
			</div>
		</form		
		
	<!-- Web Page Footer -->
		<div class="footer"></div>
	</body>
</html>
_END;

$conn->close();
?>