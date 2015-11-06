<html>
	<head>
		<title>Project 1C: Add New Movie</title>
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
		<h1> CS 143: Project 1C - Add Movie</h1>
		By Kang (Frank) Chen & Matthew Lin <br/>

		Add new movie:
		<br></br>
		<form method="post">
		<input type = "hidden" name = "click" />
		<p>Title: <input type "text" maxlength = "100" name = "title" /><br/></p>
		<p>Company: <input type "text" maxlength = "50" name = "company"/><br/></p>
		<p>Year: <input type "text" name = "year" /> (between 1900 and 2015) <br/></p>
		<p>MPAA Rating: 
			<select name="MPAA">
				<option value="G">G</option>
				<option value="NC-17">NC-17</option>
				<option value="PG">PG</option>
				<option value="PG-13">PG-13</option>
				<option value="R">R</option>
			</select></p><br/>
		Genre (check all that apply): <br/></br/>
		<?php
		$genres = array("Action", "Adult", "Adventure", "Animation", "Comedy", "Crime",
				"Documentary", "Drama", "Family", "Fantasy", "Horror", "Musical", "Mystery",
				"Romance", "Sci-Fi", "Short", "Thriller", "War", "Western");
					
			// bordered box to display results (so it doesn't get ugly)
			echo "<div style=\"border:1px solid #8D6932; width:150px;height:200px;overflow:auto;overflow-y:scroll;overflow-x:hidden;text-align:left;\" ><p>";
			foreach ($genres as $gen){
				echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
				echo "<input type=\"checkbox\" name=\"genre[]\" value=\"$gen\"/> $gen <br/> ";
			} 
			echo "</p></div>";
		?>
		<input type="hidden" name="clicked" value="23"/>
		<p><input type="submit" value="Add Movie" name="clicked"/></p>
		</form>
		</p>

		<!-- ADD MOVIE TO DATABASE -->
		<?php 
			if ($_POST["title"] && $_POST["company"] && $_POST["year"] && 
				$_POST["MPAA"] && is_numeric($_POST["year"])) {
				$title = $_POST["title"];
				$company = $_POST["company"];
				$year = $_POST["year"];
				$mpaa = $_POST["MPAA"];
				$temp = array("Action", "Adult", "Adventure", "Animation", "Comedy", "Crime",
							  "Documentary", "Drama", "Family", "Fantasy", "Horror", "Musical", "Mystery",
							  "Romance", "Sci-Fi", "Short", "Thriller", "War", "Western");
				$genres = array();

				// do some validity checks on the inputs:
				if ($year > 2015 || $year < 1900) {
					echo "ENTER A YEAR BETWEEN 1900 AND 2015.";
				} else {
					// loop through check boxes
					for ($i = 0; $i < 19; $i++) {
						if (isset($_POST["genre"][$i]))
							array_push($genres, $_POST["genre"][$i]);
					}

					// create a db connection
					$db = mysql_connect("localhost", "cs143", "");
					if(!$db) {
						$errmsg = mysql_error($db);
						print "Connection failed: $errmsg <br />";
						exit(1);
					} 
					mysql_select_db("CS143", $db);

					// get the latest mid
					$mid_query = "SELECT id FROM MaxMovieID"; 
					$mid_result = mysql_query($mid_query, $db);
					$mid_row = mysql_fetch_row($mid_result);
					$mid = $mid_row[0]+1;
					
					// query to add into database
					$add_movie_query = "INSERT INTO Movie VALUES ($mid, '$title', '$year', '$mpaa', '$company')";
					
					// check if sucessful add
					if (mysql_query($add_movie_query, $db)) {
						mysql_query($add_movie_query, $db);
						echo "<p>SUCCESSFULLY ADDED \"$title\" INTO THE DATABASE </p>";

						foreach($genres as $g) {
							mysql_query("INSERT INTO MovieGnre VALUES ($mid, '$g')", $db);
						}
						mysql_query("UPDATE MaxMovieID SET id=id+1", $db);
					} else {
						echo "ERROR IN INSERTING MOVIE!";
					}
					mysql_close($db);
				}
			}
		?>
	</body>
</html>
