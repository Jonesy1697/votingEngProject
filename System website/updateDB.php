<?php
	$user = $_COOKIE["userName"];

	include 'db_connection.php';
 
	$con = OpenCon();
	 
	$values = $_GET['select'];


	$sql = "INSERT INTO `vote`(`Id`, `election_ID`, `candidate_ID`) VALUES ($user, 1, $values)";
	$con->query($sql);
?>