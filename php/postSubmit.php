<?php
include_once 'dbconnect.php';

$link = $_POST["link"];
$caption = $_POST["caption"];

try {
	session_start();
	$_SESSION['username'] = $username;
	die();
	$accountNum = $dbh->query("SELECT accountNumber FROM Users WHERE username = '$username'");
	$sql = "INSERT INTO Posts (imgLink, postText, userID)
	VALUES ('$link', '$caption', '$accountNum')";
	$dbh->exec($sql);
	echo "<h3>DONE</h3>";
}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}
$conn = null;
