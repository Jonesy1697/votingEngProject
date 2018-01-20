<?php

	$user = $_COOKIE["userName"];
	
	include 'db_connection.php';
 
	$con = OpenCon();

	if (compareElectionDate($con)){
	
	$result = getVote($con,$user);
	
?>
<!DOCTYPE html>
<head>
	
	<title>Vote submitted</title>
		<link rel="stylesheet" href="style/style.css">
	</head>

<html>
		
	<header>
		<img class = "resize" src="images/govuk.png" alt="Government Logo">
        <button id = "helpButton" type="button">Help</button>
        <div class="clear"></div>
	</header>
		
    <div id = "spacer"></div>	
	
	<body>
		<main>	
		
			<h1>Vote already submitted:</h1>
			
			<?php echo "<p style='margin-left: 10%'>$result</p>" ?>
			
		</main>
		
	</body>
	
</html>
<?php

	}else{
	
			header("Location: http://localhost/votingSystem/votingClosed.html");
	
	}	
?>