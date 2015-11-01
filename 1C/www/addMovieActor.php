<html>
	<head>
		<title>Project 1C: Add Movie or Actor relationship</title>
	</head>

	<body>
		<h1>CS 143: Project 1C - Add Movie/Actor Relation</h1>
		Add new actor in a movie:
		<br></br>
		<form action="./addAMovieActor.php" method="GET">
			Movie: 
			<select name="mid"></select>
			<br></br>
			Actor: 
			<select name="aid"></select>
			<br></br>
			Role: 
			<input type="text" name="role" maxlength="50">
			<br></br>
			<input type="submit" value="Add it!">
		</form>
		<hr>

		<?php
		// get input
		if ($_GET["query"]) {
			$input = $_GET["query"];

			// cs 143 connection
			$db_connection = mysql_connect("localhost", "cs143", "");
			// check for no connection
			if (!$db_connection) {
				$error_msg = mysql_error($db_connection);
				print "Connection cannot be established: $error_msg <br />";
				exit(1);
			}

			// get input and select database
			$query = $input;
			mysql_select_db("CS143", $db_connection);

			// display user's query
			echo "<b>Your query:</b> ".$query." <br />";
			echo "<h3> Results from MySQL: </h3>";

			// get the result from using mysql_query 
			$result = mysql_query($query, $db_connection);

			// check that the query is valid
			if (!$result){
				$error_msg = mysql_error();
				print "The query could not be performed: $error_msg <br/>";
				exit(1);
			}

			// get the results and place into tables to be displayed later
			$k = 0;
			echo '<table border=1 cellspacing=1 cellpadding=2><tr>';

			while ($k < mysql_num_fields($result)){
				$field = mysql_fetch_field($result, $k);
				echo '<td><b>' . $field->name . '</b></td>';
				$k = $k + 1;
			}
			echo '<tr>';

		    $i = 0;
			// loop through a row of the result
			while ($row = mysql_fetch_row($result)){
				// for each element of the row, we want to display it
				for ($i = 0; $i < $k; $i++){
					if ($row[$i] == NULL){
						echo '<td> N/A </td>';
					} else {
						echo '<td>' . $row[$i] . '</td>';
					}
				}
				echo '</td><tr>';
			}
			// close tr and table tag
			echo '</tr></table>';

			// close the database
			mysql_close($db_connection);
		}
	?>
	</body>
</html>