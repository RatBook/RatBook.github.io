<?php
include_once 'dbconnect.php';

session_start();

$comment = $_POST["comment"];
$userID = urldecode($_GET['userID']);
$postID = urldecode($_GET['postID']);

try {
	$dbh->exec("
	INSERT INTO Posts (comment, userID, postID) 
	VALUES ('$comment', '$userID', '$postID')
	");
}
catch(PDOException $e) {
	echo "<h3>FAIL</h3>";
}

header("Location:../threads/".$postID.".php");
$conn = null;
die();
