<html>
<head> 
	<title> Project 1C: Search Actor/Movie</title>
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
	<br/> <br/>
	<h1>CS 143: Project 1C - Search using Keyword</h1>
			By Kang (Frank) Chen & Matthew Lin <br/><br/>
		<form /*action="."*/ method="GET">
			<input type="text" placeholder="Search" name="keyword">
			<input type="submit" value="Search" />
		</form>
	<hr>

<?php
//Utility function for a new line
function newLine() {
	echo "<br />";	//Gets new line for cleaner output
}

//Prints out the keyword you are searching for
function getResult($resultType) {
	echo "Searching match records in [$resultType] database ...<br />"; 
}

// display user's keyword search
function displayUserSearch($keyword) {
	echo "You are searching [";
	for($i = 0; $i < count($keyword); $i++) {
		echo "$keyword[$i]";
		if($i < count($keyword) - 1) {	//Handles multi-word searches
			echo " ";
		}
	}
	echo "] results...<br />";
	newLine();
}

// get input
if ($_GET["keyword"]){
	$input = $_GET["keyword"];

	// cs 143 connection
	$db_connection = mysql_connect("localhost", "cs143", "");
	// check for no connection
	if (!$db_connection) {
		$error_msg = mysql_error($db_connection);
		print "Connection cannot be established: $error_msg <br />";
		exit(1);
	}

	// get input and select database
	$keyword = explode(' ', $input);	//Keywords can be separated by spaces

	mysql_select_db("TEST", $db_connection);

	displayUserSearch($keyword);

	//Actor MySQL Query
	getResult(Actor);

	// get the result from using mysql_query 
	$actor_query = "SELECT first, last, dob, id FROM Actor WHERE (first LIKE '%{$keyword[0]}%' OR last LIKE '%{$keyword[0]}%')";
	
	for($i = 1; $i < count($keyword); $i++) {	//Handles multi-word searches for actor
		$actor_query .= " AND (first LIKE '%{$keyword[$i]}%' OR last LIKE '%{$keyword[$i]}%')";
	}																	  

	//echo $actor_query;	//Testing Purpose

	$result = mysql_query($actor_query, $db_connection);
	
	while($row = mysql_fetch_row($result)) {
    	$first = $row[0];
    	$last = $row[1];
    	$dob = $row[2];
    	$id = $row[3];	//Used to pass in aid to the showActorInfo.php file
    	print "Actor: <a href=showActorInfo.php?aid=$id>$first $last($dob)</a><br />";
	}

	newLine();

	//Movie MySQL Query
	getResult(Movie);

	// get the result from using mysql_query 
	$movie_query = "SELECT title, year, id FROM Movie WHERE title LIKE '%{$keyword[0]}%'";
	
	for($i = 1; $i < count($keyword); $i++) {	//Handle multi-word searches for movie
		$movie_query .= " AND title LIKE '%{$keyword[$i]}%'";
	}

	//echo $movie_query;	//Testing Purpose

	$result = mysql_query("$movie_query", $db_connection);
	echo $result[3];

	while($row = mysql_fetch_row($result)) {
    	$title = $row[0];
    	$year = $row[1];
    	$id = $row[2];	//Used to pass in mid to the showMovieInfo.php file
    	print "Movie: <a href=showMovieInfo.php?mid=$id>$title($year)</a><br />";
	}

	// close the database
	mysql_close($db_connection);
}
?>

</body>
</html>