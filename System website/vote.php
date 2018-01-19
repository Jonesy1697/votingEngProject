<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	include 'db_connection.php';
 
	$con = OpenCon();
		
	$sql = "SELECT CONCAT_WS('', `party_Id` ,': ', `fname`, ' ', `lname`) AS `whole_name`
			FROM `candidate`
			where constituency_ID = 'Portsmouth south'
            ORDER BY lname ASC;";
	
	
	// Runs query and saves the result
	$result = mysqli_query($con, $sql); 
			
	$num_rows = (int)mysqli_num_rows($result);
	
	$sql = "SELECT `Id`
			FROM `candidate`
			where constituency_ID = 'Portsmouth south'
            ORDER BY lname ASC;";
	
	$Ids = mysqli_query($con, $sql); 
	
	// Validates entered username and password
	$user = $_GET['voterID'];
	$password = $_GET['password'];
	$DOB = $_GET['DOB'];
	
	// Stores username as a cookie to later be used again			
	setcookie("userName",$user,time()+8*3600);
				
	// Searchs for the user password
	$sql = "SELECT password FROM voter WHERE id = '$user'";
	$passwordDB = mysqli_query($con, $sql) or die("conection failed" . $con->conect_error);
	$passwordDB = mysqli_fetch_row($passwordDB);
	$passwordDB = $passwordDB[0];
		
	$sql = "SELECT DOB FROM voter WHERE id = '$user'";
	$DOBDB = mysqli_query($con, $sql) or die("conection failed" . $con->conect_error);
	$DOBDB = mysqli_fetch_row($DOBDB);
	$DOBDB = $DOBDB[0];
	
	$count = 0;
		
	// Searches wheteher the user has voted yet
	$sql = "select count(`Id`) 
			from vote
			where `Id` = $user and `election_ID` = 1;";
	
	
	// Runs query and saves the result
	$rows = mysqli_query($con, $sql); 	
	$rows = mysqli_fetch_row($rows);
	$rows = $rows[0];
		
	// If the user details are correct, and they have not yet voted
	if ($passwordDB === $password and $DOB === $DOBDB and $rows === "0"){
?>
<!DOCTYPE html>
<head>
	
	<title>Choose a candidate</title>
		<link rel="stylesheet" href="style/style.css">
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
		
			<h1>Select a candidate:</h1>
			
			<br><br>
		
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
	} elseif ($passwordDB === $password and $DOB === $DOBDB){
		
		header("Location: http://localhost/votingSystem/alreadyVoted.php");
		
	}
	// Otherwise, the login is incorrect
	else{

	?>

<!DOCTYPE html>

<head>
	
	<title>Invalid details</title>
		<link rel="stylesheet" href="style/style.css">
	</head>

<html>
		
	<header>
		<img class = "resize" src="images/govuk.png" alt="Government Logo">
		<button id = "helpButton" type="button">Help</button>
        <div class="clear"></div>
	</header>	
	
	<body>
		<main style = "text-align: center;">		
			<p>Incorrect login</p>
			<form action="index.html">
				<input type="submit" value="Back" class = "fsSubmitButton"/>
			</form>
		</main>
	</body>
</html>	

<?php

	}

?>