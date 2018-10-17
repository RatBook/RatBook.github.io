<?php
include_once 'dbconnect.php';

session_start();

$link = $_POST["link"];
$caption = $_POST["caption"];
$username = $_SESSION['username'];
$accountNum = $dbh->query("
SELECT accountNumber 
FROM Users 
WHERE username = '$username'
");
$accountNumber = $accountNum->fetchColumn(0);

try {
	$dbh->exec("
	INSERT INTO Posts (imgLink, postText, userID) 
	VALUES ('$link', '$caption', '$accountNumber')
	");
	echo "<h3>DONE</h3>";
}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}
$conn = null;
