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

$thread = "../threads/".$postNum.".php";
$fh = fopen($thread, 'w'); 
$newPage = "
<html>
	<head>
		<title>".$caption."</title>
	</head>
	<body>
		<img src = '".$link."'>
		<h1>".$caption."</h1>
		<h2>Comments</h2>
		<form name='commentSubmit' action='<?php 
		session_start();
		include '../php/dbconnect.php';
		\$username = \$_SESSION['username'];

		\$subUser = \$dbh->query(\"
					SELECT accountNumber 
					FROM Users 
					WHERE username = '\$username'
		\")->fetchColumn(0);

		\$url = \"../php/commentSubmit.php?postID=\" . urlencode(".$postNum.") . \"&userID=\" . urlencode(\$subUser);
		echo \$url 
		?>' method='POST'>
			<input name='comment' type='text' placeholder='Comment' required />
			<button type='submit' class='btn btn-primary'>Submit</button>
		</form> 

		<?php
			\$postNum = \$_GET['postID'];
			\$rows = \$dbh->query(\"SELECT comment, userID, timestamp FROM Commments WHERE postID = '.\$postNum.' ORDER BY commentID DESC\");
			
			foreach(\$rows as \$row) {
				\$subUser = \$dbh->query(\"
					SELECT username 
					FROM Users 
					WHERE accountNumber = '\$row[1]'
				\")->fetchColumn(0);
				
				echo '<h3>'.\$row[0].'</a></h3></li>';
				echo '<h3> Submitted by: '.\$subUser.' on '.\$row[2].'</h3>';
			}
		?>
	</body>
</html>
";   
fwrite($fh, $newPage);
fclose($fh);

header("Location:../ratbook.php");
$conn = null;
die();
