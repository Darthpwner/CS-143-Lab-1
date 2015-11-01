<html>
	<head>
		<title>Project 1C: Show Movie Information</title>
	</head>
	<body>
		<?php
			function printVariables($title, $producer, $rating) {
				echo "<b>Movie Information</b><br/>";
				echo "Title: $title<br />";
    			echo "MPAA Rating: $rating<br />";
			}

			include 'search.php';

			//establish connection with the MySQL database
			$db_connection = mysql_connect("localhost", "cs143", "");
		
			//choose database to use
			mysql_select_db("CS143", $db_connection);

			$input = $_GET["mid"];   // WHAT VALUE DO I have?
			//echo "$input<br />";

			$movie_query = "SELECT title, year, company, rating FROM Movie WHERE id=$input";

			$result = mysql_query($movie_query, $db_connection);

			//Assign variables
			$row = mysql_fetch_row($result);
    		$title .= "$row[0]($row[1])";
    		$producer = $row[2];
    		$rating = $row[3];
    		
    		//Print variables
    		printVariables($title, $producer, $rating);
		?>
	</body>
</html>