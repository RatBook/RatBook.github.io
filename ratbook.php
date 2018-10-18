<!DOCTYPE html>
<html>
	<?php
		session_start();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		} else {
		echo "Log in Please";
			die();
		}
	?>
  	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/ratbook.css" />
		<link rel="stylesheet" href="css/subRat.css" />

		<!-- TITLE -->
		<title>RatBook</title>
	</head>

	<body>
		<nav>
			<ul id="subRats">
				<li><a href="ratbook.php"><h1 id="home">RatBook</h1></a></li>
				<li><a>Home</a></li>
				<li><a>Logout</a></li>
				<h1>Logged in as:</h1>
				<h1><?php echo $_SESSION['username']; ?></h1>
			</ul>
		</nav>

		

		<h1>Submit Post</h1>
		<form name="postSubmit" action="php/postSubmit.php" method="POST">
			<input name="link" type="text" placeholder="Link" required>
			<input name="caption" type="text" placeholder="Caption" required />
			<button type="submit" class="btn btn-primary">Submit</button>
		</form> 

		<h1>Posts</h1>

		<ul id="postList">
			<?php
				include 'php/dbconnect.php';
				$rows = $dbh->query("SELECT imgLink, postText, userID FROM Posts ORDER BY postID DESC");

				foreach($rows as $row) {
					$subUser = $dbh->query("
						SELECT username 
						FROM Users 
						WHERE accountNumber = '$row[2]'
					")->fetchColumn(0);

					echo "<li id='post' onclick=showModal('".$row[0]."')><img id='thumbnail' src =".$row[0].">";
					echo "<h3 id='title'>".$row[1]."</h3></li>";
					echo "<h3>Submitted by: ".$subUser."</h3>";
		    	}
		    	$dbh = null;


		    	echo
		    		'
		    		<div id="myModal" class="modal">

					  <!-- Modal content -->
					  <div class="modal-content">
					  	<img id="modal-img" />
					    <span class="close">&times;</span>
					    <p>Some text in the Modal..</p>
					  </div>

					</div>'
		    	;
			?>
		</ul>

	</body>
	<script src="js/post.js"></script>
</html>
