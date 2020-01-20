<?php		
	require_once 'sanitize.php';

	//require_once 'logindata1.php';
	//require_once 'header.php';
	require_once 'checksession.php';
	
	require_once 'logindata.php';	
	$conn = new mysqli($hn,$un,$pw,$db);
	
	if($conn->connect_error) die("Connection cannot be established");

	//Get The CardTypes available 	
		$query_str 				= "SELECT DISTINCT cardtype FROM giftcard";
		$result_cardtypes 	= $conn->query($query_str);
		if(!$result_cardtypes) die("Error Executing Query");
		$total_cardtypes 	= $result_cardtypes->num_rows;
		$login_logo_url="";
		
		if($login){
			$login_logo_url = "logout.php";
			//add tooltip later on
		}else{
			$login_logo_url = "loginPage.php";
		}
		
		//echo $login_logo_url;
	echo <<<_END
	<html>
	<!-- -->
	<!-- HEAD -->
		<head>		
			<!-- Head tag contains the metadata defined by tags like title, meta, style, link, script. The METADATA is not Displayed -->
			<title>This is the title tag on browser tab</title>
			<!-- Link for linking ext style sheets -->
			<link rel="stylesheet" href="styling.css">
			<link rel="stylesheet" href="card-list.css">
		</head>
		
	<!-- BODY -->
		<body>
		<!-- Web Page Header -->
			<div class="header">
				<div class="column33"></div><div class="column33"></div><div class="column33"></div>								
				<div class="cell" class="left"><img src="Images/Logo.png" 		width="50%"></img></div>
				<div class="cell"><h1>Gift-Cards for Your Reward-Points</h1></div>					
				<div class="cell" class="right"><a href="$login_logo_url"><img src="Images/login_logo.jpg" width="35%"><a/></img></div>		
			</div
			
			<div class="row">
					<a href="card-add.php">Add a new Gift-card</a>
			</div>
			
		<!-- Web Page Content -->		
		<div class="left20">
				<div class="column20"></div>
				<div class="cell card-list menu">
					<ul class="card-list">
_END;
	for($j=0;$j<$total_cardtypes;$j++)
	{
		$li = $result_cardtypes->fetch_array(MYSQLI_ASSOC);
		$cardtype = $li['cardtype'];		
		$query_str = "SELECT * FROM giftcard WHERE cardtype='$cardtype'";
		$result_card = $conn->query($query_str);
		if(!$result_card) die("Error Executing Query");			
		$total_cards = $result_card->num_rows;
		echo <<<_END
						<li>$cardtype</li><ul>
_END;
		for($i=0;$i<$total_cards;$i++)
		{
			$li_2			 	= $result_card->fetch_array(MYSQLI_ASSOC);
			$cardname		= $li_2['cardName'];
			$cardid 			= $li_2['cardId'];
			echo <<<_END
							<li><a href="card-details1.php?value=$cardid">$cardname<a><li>
_END;
		}				
	echo <<<_END
					</ul>
_END;
	}
	echo <<<_END
				</ul></div></div>		
		<div class="left80">
_END;
	// Show Gift card blocks
	$query_str 		= "SELECT * FROM giftcard";	
	$result_all 		= $conn->query($query_str);	
	if(!$result_all) die("Error Executing Query");	
	$total_cards1 = $result_all->num_rows;	
	for($k=0;$k<$total_cards1;$k++){
		$row 			= $result_all->fetch_array(MYSQLI_ASSOC);
		$img 			= $row['image_path'];
		$points 		= $row['points'];
		$cardname 		= $row['cardName'];
		$cardid     	= $row['cardId'];	
		
		if($k%2 == 0){
			// since we have made the size of image in px implicitly, the column width has no effect at all
			echo<<<_END
		<div class="row">
			<div class="column40"></div>
			<div class="column40"></div>
_END;
			}
		//make column view of the item
			echo <<<_END
								<div class="cell center">
										<img src="$img" class="img"></img>
										<p>Reward-Points: $points</p>
										<p><a href="card-details1.php?value=$cardid">$cardname</a></p>
								</div>
_END;
		if($k%2 != 0){
			//close row after two items
			echo<<<_END
			</div>
_END;
			}
		}	 
if($total_cards1%2!=0){
				echo<<<_END
			</div>
_END;
}	
	echo <<<_END
		</div>
		</body>
	</html>	
_END;
$conn->close();

//<div class="column25"></div>
//<div class="column75"></div>
//<div class="cell"><img src="Images/Logo.png" width="75%"></img></div>	
//<div class="cell"><h4>Welcome $username</h4></div>						
?>