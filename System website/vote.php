<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	$failed=false;
	
	include 'db_connection.php';
 
	$con = OpenCon();
	
	if( $_COOKIE["userName"] == " "){
		
		$user = $_GET['voterID'];
		$password = $_GET['password'];
		$DOB = $_GET['DOB'];
			
		// Stores username as a cookie to later be used again			
		setcookie("userName",$user,time()+8*3600);
		setcookie("password",$password,time()+8*3600);
		setcookie("DOB",$DOB,time()+8*3600);
	}
	else{
		$user = $_COOKIE["userName"];
		$password = $_COOKIE["password"];
		$DOB = $_COOKIE["DOB"];
		$failed = true;
	}
	
	if (compareElectionDate($con)){
		
		$result = getCandidates($con, $user);
				
		$num_rows = (int)mysqli_num_rows($result);
		
		$Ids = getCandidateIDs($con, $user);
		
		$count = 0;
			
		// If the user details are correct, and they have not yet voted
		if (validVote($con, $user, $password, $DOB)){
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo getElection($con) ?></title>
		<link rel="stylesheet" href="styles/style.css">
		<script src="prompts.js" type="text/javascript"></script>
	</head>
	
	<header>
		<img class = "resize" src="images/govuk.png" alt="Government Logo">
        <button id = "helpButton" type="button" onclick="votingHelp()">Help</button>
		<div class="clear"></div>
	</header>
		
    <div id = "spacer">
    </div>	
	
	<body>
	
		<main>	
		
			<?php
				if($failed==true){
					echo"<p style = \"color:red\">No candidate selected</p>";
				}
			?>
			
			<h1><?php echo (getElection($con) . " - " . getConstituency($con, $user)) ?></h1>
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

	

<html>

	<head>
		<title><?php echo getElection($con) ?></title>
		<link rel="stylesheet" href="styles/style.css">
		<script src="prompts.js" type="text/javascript"></script>
	</head>
	
	<body>
	
		<header>
			<img class = "resize" src="images/govuk.png" alt="Government Logo">
			<button id = "helpButton" type="button" onclick="incorrectLoginHelp()">Help</button>
			<div class="clear"></div>
		</header>	
		
		<div id = "spacer">
		</div>
	
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
	
			header("Location: http://localhost/votingSystem/votingClosed.php");
	
	}	
?>

<script>
	// When the user clicks on <div>, open the popup
	function helpFunction() {
		alert("To vote on the system, users must first log on. \n \n To do this, please enter your voter ID, found on your polling card, you chosen password and your date of birth.");
	}
</script>