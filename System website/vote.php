<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	include 'db_connection.php';
 
	$con = OpenCon();
	
	if (compareElectionDate($con)){
		
		$result = getCandidates($con);
				
		$num_rows = (int)mysqli_num_rows($result);
		
		$Ids = getCandidateIDs($con);
		
		// Validates entered username and password
		$user = $_GET['voterID'];
		$password = $_GET['password'];
		$DOB = $_GET['DOB'];
		
		// Stores username as a cookie to later be used again			
		setcookie("userName",$user,time()+8*3600);
					
		// Searchs for the user password
					
		$count = 0;
			
		// If the user details are correct, and they have not yet voted
		if (validVote($con, $user, $password, $DOB)){
?>
<!DOCTYPE html>
<head>
	
	<title><?php echo getElection($con) ?></title>
		<link rel="stylesheet" href="styles/style.css">
	</head>

<html>
		
	<header>
		<img class = "resize" src="images/govuk.png" alt="Government Logo">
        <button id = "helpButton" type="button">Help</button>
		<div class="clear"></div>
	</header>
		
    <div id = "spacer">
    </div>	
	
	<body>
	
		<main>	
			<h1><?php echo getElection($con) ?></h1>
			<h2>Select a candidate:</h2>
			<br>
			<form id="form1" name="form1" method="get" action="updateDB.php">
				<select name = "select" size = <?php echo "$num_rows"?>>
				<!--Creates a dropdown menu-->
					<?php while($candidate = mysqli_fetch_array($result) and $Id = mysqli_fetch_array($Ids)):;?>
						<!--Populates the dropdown menu with countries which are in the final-->
						<option value = <?php echo $Id[0]?>> <?php echo $candidate[0];?></option>
						<?php
						$count++;
						endwhile
					?>
				</select>
				<br><br><br>
				<input type="submit" value="Submit" class = "fsSubmitButton"/>
			</form>
			
		</main>
		
	</body>
	
</html>
<?php
	// If the details are correct but they have voted, redirect to the already voted page
	} elseif (validUser($con, $user, $password, $DOB)){
		
		header("Location: http://localhost/votingSystem/alreadyVoted.php");
		
	}
	// Otherwise, the login is incorrect
	else{

	?>

<!DOCTYPE html>

<head>
	
	<title><?php echo getElection($con) ?></title>
		<link rel="stylesheet" href="styles/style.css">
	</head>

<html>
		
	<header>
		<img class = "resize" src="images/govuk.png" alt="Government Logo">
		<button id = "helpButton" type="button">Help</button>
        <div class="clear"></div>
	</header>	
	
	<body>
		<main style = "text-align: center;">	
			<h1><?php echo getElection($con) ?></h1>
			<h2>Incorrect login</h2>
			<form action="index.php">
				<input type="submit" value="Back" class = "fsSubmitButton"/>
			</form>
		</main>
	</body>
</html>	

<?php

		}
	}else{
	
			header("Location: http://localhost/votingSystem/votingClosed.html");
	
	}	
?>