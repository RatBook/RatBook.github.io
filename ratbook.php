<!DOCTYPE html>
<html>
	<?php
		session_start();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		} else {
		echo "<a href='index.html'>Log in Please</a>";
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
				<li><a href="ratbook.php"><h2 id="home">RatBook</h2></a></li>
				<li><a>Home</a></li>
				<li><a href="php/logout.php">Logout</a></li>
				<h1><?php echo $_SESSION['username']; ?></h1>
				<h1>Logged in as:</h1>
				
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
				$rows = $dbh->query("SELECT imgLink, postText, userID, timestamp, postID FROM Posts ORDER BY postID DESC");

				foreach($rows as $row) {
					$subUser = $dbh->query("
						SELECT username 
						FROM Users 
						WHERE accountNumber = '$row[2]'
					")->fetchColumn(0);
					
					$url = "threads/" . $row[4];
					echo "<li id='post' onclick=showModal('".$row[0]."')>
							<img id='thumbnail' src =".$row[0]." onerror=\"this.src='https://i.imgur.com/JRTfZzG.png'\"
							 >";
					echo "<h3 id='title'><a href = '".$url."'>".$row[1]."</a></h3></li>";
					echo "<h3>Submitted by: ".$subUser." on ".$row[3]."</h3>";
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
