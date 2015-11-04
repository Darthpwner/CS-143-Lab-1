<html>
	<head>
		<title>Project 1C: Add Comment</title>
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
		<h1> CS 143: Project 1C - Add Comment</h1>
		By Kang (Frank) Chen & Matthew Lin <br/>
		Add new review to movie:
		<br></br>
		<form action="./addMovieComment.php" method="GET">
			<?php 
					$db = mysql_connect("localhost", "cs143", "");
					if(!$db) {
						$errmsg = mysql_error($db);
						print "Connection failed: $errmsg <br />";
						exit(1);
					}					
					mysql_select_db("TEST", $db);

					// select all movie id, titls, and years, and place option into dropdown
					$movie_row = mysql_query("SELECT id, title, year FROM Movie ORDER BY title ASC", $db) or die(mysql_error());
					$movieOptions = "";

					$urlID = $_GET['id'];

					while ($row=mysql_fetch_array($movie_row)) {
						$id = $row["id"];
						$title = $row["title"];
						$year = $row["year"];

						// if movie ID match the get ID specified, we can select that by default
						if ($id == $urlID)
							$movieOptions .= "<option value =\"$id\" selected>".$title." [".$year."]</option>";
						else
							$movieOptions .= "<option value =\"$id\">".$title." [".$year."]</option>";
					}
			?>
			Your Name: 					<input type = "text" name = "name" value = "<?php echo htmlspecialchars($_GET['name']); ?>" maxlength = "30"><br/>
			Movie:     					<select name = "id"> <?=$movieOptions?> </select> <br/>
			Rating (out of 5 stars):    <select name = "rating">
											<option value = "5"> 5 </option>
											<option value = "4"> 4 </option>
											<option value = "3"> 3 </option>
											<option value = "2"> 2 </option>
											<option value = "1"> 1 </option>
									    </select><br/>
			Review:    <br/> <textarea name = "comment" cols="80" rows = "10" values=><?php echo htmlspecialchars($_GET['comment']); ?>
				 		  </textarea><br/>
			<br/>
			<input type = "submit" value = "Submit Review" />
		</form>

		<?php 
			// get the user's inputs
			$name = trim($_GET["name"]);
			$movie = $_GET["id"];
			$rating = $_GET["rating"];
			$comment = trim($_GET["comment"]);

			// pass in the user input
			if ($name == "" && $movie == "" && $rating == "" && $comment == ""){
			} else if ($movie == "") {
				echo "MUST SELECT MOVIE FROM THE LIST";
			} else if ($rating == "" || $rating > 5 || $rating < 1) {
				echo "MUST SELECT VALID RATING";
			} else {

				if ($name == "")
					$name = "Anonymous";

				//escape single-quotes in the inputs to make sure it doesn't break the string up
				$name = mysql_escape_string($name);
				$movie = mysql_escape_string($movie);
				$comment = mysql_escape_string($comment);

				$query = "INSERT INTO Review (name, time, mid, rating, comment) 
					  	  VALUES ('$name', now(), '$movie', '$rating', '$comment')";
				
				// issue the query and get the result
				$result = mysql_query($query, $db) or die(mysql_error());

				// output message for successful insertion
				echo "Movie review has been successfully added";
			}
			mysql_close($db);
		?>
		
	</body>
</html>