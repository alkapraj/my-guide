<?php
	require_once 'checksession.php';
?>
<html>
<!-- -->
<!-- HEAD -->
	<head>
	
		<!-- Head tag contains the metadata defined by tags like title, meta, style, link, script. The METADATA is not Displayed -->
		<title>This is the title tag on browser tab</title>

		<!-- Link for linking ext style sheets -->
		<link rel="stylesheet" href="styling.css">
		<link rel="stylesheet" href="card-add.css">
	
	</head>
<!-- BODY -->
	<body id="displayGiftCard">

	<!-- Web Page Header -->
		<div class="row header">
			<div class="column25">
				<img src="Images/Logo.png" width="75%"></img>
			</div>			
			<div class="column50">
				<h1>Add a new Gift-Card</h1>
			</div>			
			<div class="column25" class="right"><a href="logout.php"><img src="Images/login_logo.jpg" width="35%"><a/></img></div>		
		</div>			
		
	<!-- Web Page Content -->		
		
		<form action="card-add1.php" method="POST">
			<div class="content">
				<div id="add" class="row right">
						<input type="submit" name="addCard" value="ADD" class="button"><br>
				</div>
				<br>
				<div class="row" style="height:50%">
					<div class="column33">
						<fieldset>
								<p>Upload Image:</p>
								<p><input type='file' name='filename' size='10'> </p>
						</fieldset>
					</div>
					
					<div class="column67">
						<fieldset id="fieldset1">
							<!-- <legend>Card Details</legend> -->
							<!-- Card ID -->			
							<div class="row75">
								<div class="column25">Card ID: </div>
								<div class="column50"><input type="text" name="cardID" size="30" maxlength="11"></div>
							</div>
							<!-- Card Name -->
							<div class="row75">
								<div class="column25">Card Name: </div>
								<div class="column50"><input type="text" name="cardName" size="30" maxlength="100"><br></div>
							</div>
							<!-- Card Type: -->
							<div class="row75">
								<div class="column25">Card Type: </div>
								<div class="column50"><input type="text" name="cardType" size="30" maxlength="100"><br></div>
							</div>
							<!-- Card Value: -->
							<div class="row75">
								<div class="column25">Card Value: </div>
								<div class="column50"><input type="text" name="cardValue" size="30" maxlength="10"><br></div>
							</div>
							<!-- Reward Points: -->
							<div class="row75">
								<div class="column25">Reward Points: </div>
								<div class="column50"><input type="text" name="rewardPoints" size="30" maxlength="50"><br></div>			
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