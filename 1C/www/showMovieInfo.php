<html>
	<head>
		<title>Project 1C: Show Movie Information</title>
	</head>
	<body>
		<?php
			$movie_query = "SELECT title, producer, rating, year FROM Movie WHERE title LIKE '%{$keyword[0]}%'";

			//After user clicks, get information from the link!
			$title = "Bruno";
			$year = "2009";
			$rating = "5";
			$company = "YOLO Film";

			echo "$title<br />";
			echo "$year<br />";
			echo "$rating<br />";
			echo "$company<br />";

			include 'search.php';
		?>
	</body>
</html>