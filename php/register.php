<?php
include_once 'dbconnect.php';

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$emailAddress = $_POST["emailAddress"];
$username = $_POST["username"];
$password = $_POST["password"];

try {
	$sql = "
	INSERT INTO Users (fname, lname, emailAddress, username, password)
	VALUES ('$fname', '$lname', '$emailAddress', '$username', '$password')";
	$dbh->exec($sql);
	session_start();
	$_SESSION['loggedin'] = true;
	$_SESSION['admin'] = false;
	$_SESSION['username'] = $username;
	header("Location: ../ratbook.php");
	die();
}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}
$conn = null;
