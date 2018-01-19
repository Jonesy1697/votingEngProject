<?php
 
 $date = "2018-05-03"; //date("Y-m-d");
 
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "votingDB";
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db, "3306") or die("Connect failed: %s\n". $conn -> error);
  
 return $conn;
 }
 
function CloseCon($con)
 {
 $con -> close();
 }
   
function compareElectionDate($con){
	   
	$sql = "SELECT `electionDate` FROM `election` WHERE `id` = 1;";
	$electionDate = mysqli_query($con, $sql);
	$electionDate = mysqli_fetch_row($electionDate);
	$electionDate = $electionDate[0];
	
	if ($electionDate === $GLOBALS['date']){
		
		return true;
	
	}else{
		
		return false;
		
	}
	
	}   
?>