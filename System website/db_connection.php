<?php
 
 $date = date("Y-m-d");
 
function getCandidates($con){
	   
	$sql = "SELECT CONCAT_WS('', `party_Id` ,': ', `fname`, ' ', `lname`) AS `whole_name`
				FROM `candidate`
				where constituency_ID = 'Portsmouth south'
				ORDER BY lname ASC;";
		
		
		// Runs query and saves the result
	return mysqli_query($con, $sql); 
	
}

function getVote($con, $user){
	   
	$sql = "SELECT CONCAT_WS('', candidate.`party_Id` ,': ', candidate.`fname`, ' ', candidate.`lname`) AS `whole_name`
			FROM candidate
			INNER JOIN vote ON vote.`candidate_ID`=candidate.Id
			where vote.Id = '$user';";
	
	
		// Runs query and saves the result
	$result = mysqli_query($con, $sql); 
	$result = mysqli_fetch_row($result);
	return $result[0]; 
	
}

function getPassword($con, $user){
	
	$sql = "SELECT password FROM voter WHERE id = '$user'";
	$passwordDB = mysqli_query($con, $sql) or die("connection failed" . $con->conect_error);
	$passwordDB = mysqli_fetch_row($passwordDB);
	return $passwordDB[0];
		
}

function getDOB($con, $user){
	
	$sql = "SELECT DOB FROM voter WHERE id = '$user'";
	$DOBDB = mysqli_query($con, $sql) or die("connection failed" . $con->conect_error);
	$DOBDB = mysqli_fetch_row($DOBDB);
	return $DOBDB[0];
		
}

function getCandidateIDs($con){

	$sql = "SELECT `Id`
			FROM `candidate`
			where constituency_ID = 'Portsmouth south'
			ORDER BY lname ASC;";
		
	return mysqli_query($con, $sql); 
		
}
 
function getElection($con){
		
	$sql = "SELECT `name` FROM `election` order by `electionDate` DESC;";
	$name = mysqli_query($con, $sql);
	$name = mysqli_fetch_row($name);
	return $name[0];
	
}
 
function OpenCon(){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "votingDB";
	 
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db, "3306") or die("Connect failed: %s\n". $conn -> error);
	  
	return $conn;
 }
 
function CloseCon($con){
	$con -> close();
 } 
   
function compareElectionDate($con){
	
	$date = $GLOBALS['date'];
	
	$sql = "SELECT `electionDate` FROM `election` order by `electionDate` DESC;";
	$electionDate = mysqli_query($con, $sql);
	$electionDate = mysqli_fetch_row($electionDate);
	$electionDate = $electionDate[0];
	
	if ($electionDate === $date){
		
		return true;
	
	}else{
		
		return false;
		
	}
	
}   

function validUser($con, $user, $password, $DOB){
	
	$passwordDB = getPassword($con, $user);
		
	$DOBDB = getDOB($con, $user);
				
	if ($passwordDB === $password and $DOBDB === $DOB){
		return true;
	}else{
		return false;
	}
	
}

function notAlreadyVoted($con, $user){
	
	$sql = "select count(`Id`) 
			from vote
			where `Id` = '$user' and `election_ID` = 1;";
		
	// Runs query and saves the result
	$rows = mysqli_query($con, $sql); 
				
	if ($rows != false){
		$rows = mysqli_fetch_row($rows);
		$rows = $rows[0];
	}else{
		$rows = "0";
	}
	
	if ($rows === "0"){
		return true;
	}
	else{
		return false;
	}
	
}

function validVote($con, $user, $password, $DOB){
					
	if (validUser($con, $user, $password, $DOB) and notAlreadyVoted($con, $user)){
		return true;
	}
	else{
		return false;
	}
}

?>