<?php

	$user = $_COOKIE["userName"];
	
	include 'db_connection.php';
 
	$con = OpenCon();

	if (compareElectionDate($con)){
	
	$result = getVote($con,$user);
	
?>
<!DOCTYPE html>
<html>	
	<head>
		<title><?php echo getElection($con) ?></title>
		<link rel="stylesheet" href="styles/style.css">		
		<script src="prompts.js" type="text/javascript"></script>
	</head>
	
	<body>
	
		<header>
			<img class = "resize" src="images/govuk.png" alt="Government Logo">
			<button id = "helpButton" type="button" onclick="alreadyVotedHelp()">Help</button>
			<div class="clear"></div>
		</header>
		
			<div id = "spacer"></div>	
		
		<main>	
		
			<h1><?php echo getElection($con) ?></h1>
			<br>
			<h2>Vote already submitted:</h2>
			
			<?php echo "<p style='margin-left: 10%'>$result</p>" ?>
			
		</main>
		
	</body>
	
</html>
<?php

	}else{
	
			header("Location: http://localhost/votingSystem/votingClosed.php");
	
	}	
?>