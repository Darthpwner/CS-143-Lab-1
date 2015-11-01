<html>
	<head>
		<title>Project 1C: Show Movie Information</title>
	</head>
	<body>
		<?php
			include 'search.php';

			$input = $_GET["mid"];   // WHAT VALUE DO I have?
			echo "$input<br />";

			$movie_query = "SELECT title, producer, rating, year FROM Movie WHERE title LIKE '%{$keyword[0]}%'";

		?>
	</body>
</html>