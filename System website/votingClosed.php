<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	include 'db_connection.php';
 
	$con = OpenCon();
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
            <button id = "helpButton" type="button" onclick="votingClosedHelp()">Help</button>
            <div class="clear"></div>
		</header>
		
        <div id = "spacer">
        </div>
        
		<main style = "text-align: center;">
			<h1><?php echo getElection($con) ?></h1>
			<h2>Voting is not currently open<h2>
			<br>			
		</main>		
	</body>	
</html>