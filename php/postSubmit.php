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
")->fetchColumn(0);

try {
	$dbh->exec("
	INSERT INTO Posts (imgLink, postText, userID) 
	VALUES ('$link', '$caption', '$accountNum')
	");
}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}

header("Location:../ratbook.php");
$conn = null;
die();
