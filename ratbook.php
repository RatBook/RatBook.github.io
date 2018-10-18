<!DOCTYPE html>
<html>
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
			<a href="ratbook.php"><h1 id="home">RatBook</h1></a>
			<ul id="subRats">
				<li>Home</li>
			</ul>
		</nav>

		<h1>
            <?php
              session_start();
			  echo $_SESSION['username'];
			  	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				} else {
				echo "Log in Please";
					die();
				}
			?>
		</h1>

		<h2>Submit Post</h2>
		<form name="postSubmit" action="php/postSubmit.php" method="POST">
			<input name="link" type="text" placeholder="Link" required>
			<input name="caption" type="text" placeholder="Caption" required />
			<button type="submit" class="btn btn-primary">Submit</button>
		</form> 

		<h2>Posts</h2>

		<ul id="postList">
			<?php
				include 'php/dbconnect.php';
				$rows = $dbh->query("SELECT imgLink, postText FROM Posts");
				foreach($rows as $row) {
				echo "<li id='post' onclick=showModal('".$row[0]."')><img id='thumbnail' src =".$row[0].">";
				echo "<h3 id='title'>".$row[1]."</h3></li>";
		    	}
		    	$dbh = null;


		    	echo
		    		'
		    		<button id="myBtn">Open Modal</button>
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
