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

$postNum = $dbh->query("
SELECT postID
FROM Posts 
WHERE imgLink = '$link' 
ORDER BY postID DESC
LIMIT 1
")->fetchColumn(0);

$thread = "../threads/".$postNum.".html"; // or .php   
$fh = fopen($thread, 'w'); // or die("error");  
$newPage = "
<head>
<img src = ".$row[0].">
<h1>".$caption"</h1>
</head>
";   
fwrite($fh, $newPage);
fclose($fh);

header("Location:../threads/".$postNum.".html");
$conn = null;
die();
