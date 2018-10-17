<?php
include_once 'dbconnect.php';

$link = $_POST["link"];
$caption = $_POST["caption"];

try {
	session_start();
	$_SESSION['username'] = $username;
	die();
	$sql = "INSERT INTO Posts (imgLink, postText, userID)
	VALUES ('$link', '$caption', '$username')";
	$dbh->exec($sql);

}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}
$conn = null;
