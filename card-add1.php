<?php

require_once 'sanitize.php';
require_once 'logindata.php';

$conn = new mysqli($hn,$un,$pw,$db);
	
if($conn->connect_error) 
{
	die("Connection cannot be established");
}

if(isset($_POST['cardID']))
{
	$cardid 		= sanitizeString($_POST['cardID']);	
	$cardname 	= sanitizeString($_POST['cardName']);	
	$cardtype 	= sanitizeString($_POST['cardType']);	
	$cardvalue 	= sanitizeString($_POST['cardValue']);	
	$points 		= sanitizeString($_POST['rewardPoints']);	
	
	if(!empty($cardid))
	{	
		echo $cardid.$cardname.$cardtype.$cardvalue.$points;
		$query_str	= "INSERT INTO giftcard(cardId,cardName,cardType,cardValue,points,image_path) 
								VALUES ('$cardid','$cardname','$cardtype','$cardvalue','$points','Images/acicsbag.jpg');";
		$result			= $conn->query($query_str);
		
		if(!$result)
		{	
			die("Error Executing Query");
		}
		else
		{
			header("Location: card-list.php");
		}
	}
}

$conn->close();

?>