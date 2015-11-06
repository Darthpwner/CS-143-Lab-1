<html>
	<head>
		<title>Project 1C: Show Movie Information</title>
	</head>
	<body>
		<?php
			function printVariables($title, $producer, $rating, $director, $genre) {
				echo "<b>Movie Information</b><br/>";
				echo "Title: $title<br />";
				echo "Producer: $producer<br />";
    			echo "MPAA Rating: $rating<br />";
    			echo "Director: $director<br/>";
    			echo "Genre: $genre<br/>";
    			echo "<br/>";
			}

			function printCast() {
				echo "<b>Cast</b><br/>";
			}

			function printReviews() {
				echo "<b>Reviews</b><br/>";
			}

			include 'search.php';

			//establish connection with the MySQL database
			$db_connection = mysql_connect("localhost", "cs143", "");
		
			//choose database to use
			mysql_select_db("CS143", $db_connection);

			$input = $_GET["mid"];   

			$movie_query = "SELECT title, year, company, rating FROM Movie WHERE id=$input";

			$result = mysql_query($movie_query, $db_connection);

			//Assign variables
			$row = mysql_fetch_row($result);
    		$title .= "$row[0]($row[1])";
    		$producer = $row[2];
    		$rating = $row[3];
    		
    		$director_query = "SELECT D.first, D.last FROM Director D, MovieDirector MD WHERE MD.did = D.id AND MD.mid = $input";

    		$result2 = mysql_query($director_query, $db_connection);

    		//Assign variables
    		$row = mysql_fetch_row($result2);
    		$directorName .= "$row[0] $row[1]";

    		$genre_query = "SELECT genre FROM MovieGenre MG WHERE MG.mid = $input";

    		$result3 = mysql_query($genre_query, $db_connection);

    		//Assign variables
    		$row = mysql_fetch_row($result3);
    		$genre = $row[0];
   
   			//Print variables
            if($input != "") {
                printVariables($title, $producer, $rating, $directorName, $genre);    
            }
    		
    		$cast_query = "SELECT A.first, A.last, MA.role, MA.aid FROM MovieActor MA, Actor A WHERE MA.mid = $input AND MA.aid = A.id";

    		$result4 = mysql_query($cast_query, $db_connection);

    		//Print cast
            if($input != "") {
                printCast();    
            }
    		
    		while($row = mysql_fetch_row($result4)) {
		   		//Assign variables
    			$name = "$row[0] $row[1]";
    			$role = $row[2];
                $aid = $row[3];
                print "<a href=showActorInfo.php?aid=$aid>$name</a> as $role<br />";
    		}		

    		echo "<br/>";

    		$reviews_query = "SELECT AVG(rating), COUNT(rating) FROM Review R WHERE mid = $input";
    		
    		$result5 = mysql_query($reviews_query, $db_connection);

    		//Print reviews
            if($input != "") {
                printReviews();    
            }
    		
    		$row = mysql_fetch_row($result5);
    		$average_rating = $row[0];
    		$number_of_ratings = $row[1];

            if($input != "") {
                if($average_rating == 0) {
                    print "Average rating: No reviews have been added.";
                } else {
                    print "Average rating: $average_rating/5 stars by $number_of_ratings review(s).<br/></br>";
                }
            }

    		$comments_query = "SELECT time, name, rating, comment FROM Review WHERE mid = $input ORDER BY time DESC";

    		$result6 = mysql_query($comments_query, $db_connection);

    		while($row = mysql_fetch_row($result6)) {
    			$time = $row[0];
    			$name = $row[1];
    			$rating = $row[2];
    			$comment = $row[3];

    			print "$time by $name<br/>$rating out of 5 stars</br>$comment <br/></br>";
    		}
		?>
	</body>
</html>