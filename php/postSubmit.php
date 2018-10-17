<?php
include_once 'dbconnect.php';

$link = $_POST["link"];
$caption = $_POST["caption"];

session_start();

$username = $_SESSION['username'];
$accountNum = $dbh->query("SELECT accountNumber FROM Users WHERE username = '$username'");
echo $accountNum;
echo "Submit";


try {
	$sql = "INSERT INTO Posts (imgLink, postText, userID) VALUES ('$link', '$caption', '$accountNum')";
	$dbh->exec($sql);
	echo "<h3>DONE</h3>";
}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}
$conn = null;
