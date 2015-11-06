<html>
	<head>
		<title>Project 1C: Add Movie or Actor relationship</title>
	</head>
	<style>
		ul {
		    float: left;
		    width: 100%;
		    padding: 0;
		    margin: 0;
		    list-style-type: none;
		}

		li {
		    display: inline;
		}
	</style>
	<table border="0">
		<tr>
			<a href = "addActorDirector.php"> Add Actor or Director </a> <br />
			<a href = "addMovieInfo.php"> Add Movie Info </a>	<br />
			<a href = "addMovieComment.php"> Add Movie Comment </a>	<br />
			<a href = "addMovieActor.php"> Add Movie/Actor </a>	<br />
			<a href = "addMovieDirector.php"> Add Movie/Director </a>	<br />
			<a href = "showActorInfo.php"> Show Actor Info </a>	<br />
			<a href = "showMovieInfo.php"> Show Movie Info </a>	<br />
			<a href = "search.php"> Search With Keyword</a>	<br />
		</tr>
	</table>
	<body>
		<h1>CS 143: Project 1C - Add Movie/Actor Relation</h1>
		Add new actor in a movie:
		<br></br>
		<form action="./addAMovieActor.php" method="GET">
			<?php 
				// create db connection
				$db = mysql_connect("localhost", "cs143", "");
				if(!$db) {
					$errmsg = mysql_error($db);
					print "Connection SHIT failed: $errmsg <br />";
					exit(1);
				}					
				mysql_select_db("CS143", $db);

				// select all movie ids, titles, and years and place as options into dropdown
				$movie = mysql_query("SELECT id, title, year FROM Movie ORDER BY title ASC", $db);
				$movieOptions = "";
				while($row = mysql_fetch_array($movie)){
					$id = $row["id"];
					$title = $row["title"];
					$year = $row["year"];
					$movieOptions .= "<option value=\"$id\">".$title." [".$year."]</option>";
				}

				// select all actor ids, first name, last name, dob, and place as options in dropdown
				$actor = mysql_query("SELECT id, first, last, dob FROM Actor ORDER BY first ASC", $db);
				$actorOptions = "";
				while ($row=mysql_fetch_array($actor)) {
					$id = $row["id"];
					$first = $row["first"];
					$last = $row["last"];
					$dob = $row["dob"];
					$actorOptions .= "<option value = \"$id\">".$first." ".$last." [".$dob."]</option>";
				}
				mysql_free_result($actor);
			?>
			Movie: <select name="mid">
						<?=$movieOptions?>
				   </select><br/>
			Actor: <select name="aid">
						<?=$actorOptions?>
				   </select><br/>
			Role: <input type = "text" name="role" value = "<?php echo htmlspecialchars($_GET['role']);?>" maxlength = "50"> <br/>
			<br/>
			<input type = "submit" value = "Link Actor to Movie" />
		</form>
		<?php 
				// get user input
			$role = trim($_GET["role"]);
			$movie = $_GET["mid"];
			$actor = $_GET["aid"];

			// pass in user inputs
			if ($movie == "" && $actor == "" && $role == "") {	
			} elseif ($movie == "") {
				echo "MUST SELECT MOVIE FROM LIST.";
			} elseif ($actor == "") {
				echo "MUST SELECT ACTOR FROM THE LIST.";
			} else {
				$movie = mysql_escape_string($movie);
				$actor = mysql_escape_string($actor);
				$role = mysql_escape_string($role);

				$query = "INSERT INTO MovieActor (mid, aid, role) VALUES ('$movie', '$actor', '$role')";

				$result = mysql_query($query, $db) or die(mysql_error());
				echo "ACTOR LINKED WITH MOVIE SUCCESSFULLY.";
			}

			mysql_close($db);
		?>

	</body>
</html>