<?php
	$user = $_COOKIE["userName"];

	include 'db_connection.php';
 
	$con = OpenCon();
		
	$values = $_GET['select'];

	$sql = "select count(`Id`) 
			from vote
			where `Id` = $user and `election_ID` = 1;";
	
	
	// Runs query and saves the result
	$rows = mysqli_query($con, $sql); 	
	$rows = mysqli_fetch_row($rows);
	
	if ($rows[0] === 0){
	
	$sql = "INSERT INTO `vote`(`Id`, `election_ID`, `candidate_ID`) VALUES ($user, 1, $values)";
	
	$con->query($sql);
	
	$sql = "SELECT CONCAT_WS('', candidate.`party_Id` ,': ', candidate.`fname`, ' ', candidate.`lname`) AS `whole_name`
			FROM candidate
			INNER JOIN vote ON vote.`candidate_ID`=candidate.Id
			where vote.Id = $user;";
	
	
	// Runs query and saves the result
	$result = mysqli_query($con, $sql); 
	$result = mysqli_fetch_row($result);
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
		
			<h1>Vote submitted:</h1>
			
			<?php echo "<p style='margin-left: 10%'>$result[0]</p>" ?>
			
		</main>
		
	</body>
	
</html>

<?php
	}
	else{
		
		$sql = "SELECT CONCAT_WS('', candidate.`party_Id` ,': ', candidate.`fname`, ' ', candidate.`lname`) AS `whole_name`
			FROM candidate
			INNER JOIN vote ON vote.`candidate_ID`=candidate.Id
			where vote.Id = $user;";
	
	
		// Runs query and saves the result
		$result = mysqli_query($con, $sql); 
		$result = mysqli_fetch_row($result);
	
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
			
			<?php echo "<p style='margin-left: 10%'>$result[0]</p>" ?>
			
		</main>
		
	</body>
	
</html>
<?php
	}	
?>