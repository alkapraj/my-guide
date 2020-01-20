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
	
	if(!empty($cardid))
	{	
		$query_str	= "DELETE FROM giftcard WHERE cardId='$cardid'";
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