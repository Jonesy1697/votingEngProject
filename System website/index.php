<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	include 'db_connection.php';
 
	$con = OpenCon();
	
	if (compareElectionDate($con)){
	
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
            <button id = "helpButton" type="button" onclick="loginHelp()">Help</button>
            <div class="clear"></div>
		</header>
		
        <div id = "spacer">
        </div>
        
		<main style = "text-align: center;">
		
		<h1><?php echo getElection($con) ?></h1>
			<form name = "login" action="vote.php" method="get" accept-charset="utf-8">
			<!--Creates the login form which directs to the validation on vote.php-->
                
				<label for = "username">Voter ID</label>
                <br>
				<input type = "username" name="voterID" placeholder="voterID" required>
			
				<br><br>
				
				<label for = "password">Password</label>
                <br>
				<input type = "password" name="password" placeholder="Password" required>              
                
				<br><br>
				
                <label for = "DOB">DOB</label>
                <br> 
                <input type="date" name="DOB" required>
                
             	<br><br><br>
                           
				<input type = "submit" value="Login" class = "fsSubmitButton">
                
			</form>	
			
			<br>
			
			<p style = "font-size: 90%;">(Password is case sesnsitive)<p>	
			
			<br>			
		</main>		
	</body>	
</html>

<?php
	}else{
	
			header("Location: http://localhost/votingSystem/votingClosed.html");
	
	}
?>