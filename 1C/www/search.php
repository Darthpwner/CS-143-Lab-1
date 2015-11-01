<html>
<head> 
	<title> Project 1C: Search Actor/Movie</title>
</head>
  
<body>
	Search for actors/movies
		<form /*action="."*/ method="GET">
			<input type="text" name="keyword">
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

	mysql_select_db("CS143", $db_connection);

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
	echo $result[3];

	while($row = mysql_fetch_row($result)) {
    	$first = $row[0];
    	$last = $row[1];
    	$dob = $row[2];
    	print "Actor: <a href=showActorInfo.php?id=$result[3]/>$first $last($dob)</a><br />";
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
    	print "Movie: <a href=showMovieInfo.php?id=$result[2]/>$title($year)</a><br />";
	}

	// close the database
	mysql_close($db_connection);
}
?>

</body>
</html>