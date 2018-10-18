<!DOCTYPE html>
<html>
  	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/ratbook.css" />

		<!-- TITLE -->
		<title>RatBook</title>
	</head>

	<body>
		<nav>
			<h1 id="home">RatBook</h1>
			<ul id="subRats">
				<li>Home</li>
			</ul>
		</nav>

		<h1>
            <?php
              session_start();
              echo $_SESSION['username'];
            ?>
		</h1>

		<h2>Submit Post</h2>
		<form name="postSubmit" action="php/postSubmit.php" method="POST">
			<input name="link" type="text" placeholder="Link" required>
			<input name="caption" type="text" placeholder="Caption" required />
			<button type="submit" class="btn btn-primary">Submit</button>
		</form> 

		<h2>Posts</h2>
		<?php
				include 'php/dbconnect.php';
				$rows = $dbh->query("SELECT imgLink, postText FROM Posts");
				foreach($rows as $row) {
				echo "<img src =".$row[0].">";
				echo "<h3>".$row[1]."</h3>";
		    	}
		    	$dbh = null;
		?>
	</body>
</html>
