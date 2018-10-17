<!DOCTYPE html>
<html>
  	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- TITLE -->
		<title>RatBook</title>
	</head>

	<body>
		<h1>
            <?php
              session_start();
              echo $_SESSION['username'];
            ?>
		</h1>
	</body>
</html>
