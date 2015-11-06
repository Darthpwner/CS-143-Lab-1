<html>
	<head>
		<title>Project 1C: Show Actor Information</title>
	</head>

	<body>
		<?php
			function printVariables($name, $sex, $dob, $dod) {
				echo "<b>Actor Information</b><br/>";
				echo "Name: $name<br />";
    			echo "Sex: $sex<br />";
    			echo "Date of Birth: $dob<br />";

    			echo "Date of Death: ";
    			//Print variables
				if($dod != "") {
					echo "$row[4]<br />";
				} else {
					echo "Still Alive<br />";
				}

				echo "<br/>";
			}
			
			include 'search.php';

			//establish connection with the MySQL database
			$db_connection = mysql_connect("localhost", "cs143", "");
		
			//choose database to use
			mysql_select_db("TEST", $db_connection);

			$input = $_GET["aid"]; 
			
			$actor_query = "SELECT first, last, sex, dob FROM Actor WHERE id=$input";

			$result = mysql_query($actor_query, $db_connection);

			//Assign variables
			$row = mysql_fetch_row($result);
    		$name .= "$row[0] $row[1]";
    		$sex = $row[2];
    		$dob = $row[3];
    		$dod = $row[4];

    		//Print variables
    		if($input != "") {
    			printVariables($name, $sex, $dob, $dod);	
    		}
    		
     		//Free up the query results
			mysql_free_result($result);

    		$roles_query = "SELECT MA.role, M.title, M.year, MA.mid FROM MovieActor MA, Movie M WHERE MA.aid = $input AND 
    						MA.mid = M.id ORDER BY M.year DESC";

    		$result2 = mysql_query($roles_query, $db_connection);

    		if($input != "") {
    			echo "<b>Roles </b><br/>";
    		}

    		$movie_query = "SELECT MA.mid FROM MovieActor MA, Movie M WHERE MA.mid = M.id";

    		$result3 = mysql_query($movie_query, $db_connection);

 			while($row2 = mysql_fetch_row($result2)) {
    			$role = $row2[0];
    			$title = $row2[1];
    			$year = $row2[2];
    			$mid = $row2[3];
    			print "'$role' in <a href=showMovieInfo.php?mid=$mid>$title ($year)</a><br />";	
    		}			

    		//Free up the query results
			mysql_free_result($result2);
		?>
	</body>
</html>