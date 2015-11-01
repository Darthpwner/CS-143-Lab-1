<html>
	<head>
		<title>Project 1C: Add an existing director to a movie</title>
	</head>	
	<table border="0">
		<tr>
			<a href = "addActorDirector.php"> Add Actor or Director </a>
			<br/>
			<a href = "addMovieInfo.php"> Add Movie Info </a>
			<br/>
			<a href = "addMovieComment.php"> Add Movie Comment </a>
			<br/>
			<a href = "addMovieActor.php"> Add Movie Actor </a>
			<br/>
			<a href = "showActorInfo.php"> Show Actor Info </a>
			<br/>
			<a href = "showMovieInfo.php"> Show Movie Info </a>
			<br/>
			<a href = "search.php"> Search </a>
			<br/>
		</tr>
	</table>

	<body>
		<h1>CS 143: Project 1C - Add Movie Director</h1>
		Add an existing director to movie:
		<br></br>
		<form action="./addMovieDirector.php" method = "GET">
			<?php 
				// create db connection
				$db = mysql_connect("localhost", "cs143", "");
				if(!$db) {
					$errmsg = mysql_error($db);
					print "Connection SHIT failed: $errmsg <br />";
					exit(1);
				}					
				mysql_select_db("TEST", $db);

				// select all movie ids, titles, and years; place as option
				$movies = mysql_query("SELECT id, title, year FROM Movie ORDER BY title ASC", $db);
				$movieOptions = "";
				while ($row = mysql_fetch_array($movies)){
					$id = $row["id"];
					$title = $row["title"];
					$year = $row["year"];
					$movieOptions .= "<option value=\"$id\">".$title." [".$year."]</option>";
				}

				// select all movie ids, titles, and years as options in a dropdown
				$director = mysql_query("SELECT id, first, last, dob FROM Director ORDER BY first ASC", $db);
				$directorOptions = "";
				while($row=mysql_fetch_array($director)){
					$id = $row["id"];
					$first = $row["first"];
					$last = $row["last"];
					$dob = $row["dob"];
					$directorOptions .= "<option value=\"$id\">".$first." ".$last." [".$dob."]</option>";
				} 
				mysql_free_result($director);
			?>
			Movie: <select name="mid"> 
						<?=$movieOptions?>
				   </select><br/>
			Director: <select name="did">
						<?=$directorOptions?>
					  </select><br/>
			<br/>
			<input type = "submit" value = "Link Director to Movie" />
		</form>
		</p>
		<?php 
			// get the user's inputs
			$role = trim($_GET["role"]);
			$movie = $_GET["mid"];
			$director = $_GET["did"];

			// pass in user inputs
			if ($movie == "" && $director == "" && $role == ""){
			} elseif ($movie == "") {
				echo "MUST SELECT MOVIE FROM LIST.";
			} elseif ($director == "") {
				echo "MUST SELECT DIRECTOR FROM LIST.";
			} else {
				// escape single quotes in the inputs to make sure it doesn't break query
				$movie = mysql_escape_string($movie);
				$director = mysql_escape_string($director);

				$query = "INSERT INTO MovieDirector (mid, did) VALUES ('$movie', '$director')";
				// echo $query;
				// issue a query using database connection
				$result = mysql_query($query, $db) or die(mysql_error());
				echo "Director has linked with Movie successfully.";
			}
			mysql_close($db);
		?>
	</body>
</html>
