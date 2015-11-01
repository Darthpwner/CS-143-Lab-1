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
function getResult($resultType) {
	//TODO
	echo "Searching match records in [$resultType] database ...<br />"; 
	// get the result from using mysql_query 
	if($resultType == Actor) {
		echo "ACTOR";
	} else {	//resultType == Movie
		echo "MOVIE";
	}
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
	echo "] results...<br /><br />";
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

	echo "<br />";

	// get the result from using mysql_query 
	$actor_query = "SELECT first, last, dob FROM Actor WHERE (first LIKE '%{$keyword[0]}%' OR last LIKE '%{$keyword[0]}%')";
	
	for($i = 1; $i < count($keyword); $i++) {	//Handles multi-word searches for actor
		$actor_query .= " AND (first LIKE '%{$keyword[$i]}%' OR last LIKE '%{$keyword[$i]}%')";
	}																	  

	//echo $actor_query;	//Testing Purpose

	$result = mysql_query($actor_query, $db_connection);

	while($row = mysql_fetch_row($result)) {
    	$first = $row[0];
    	$last = $row[1];
    	$dob = $row[2];
    	print "Actor: $first $last($dob)<br />";
	}

	 getResult(Movie);

	 echo "<br />";

	//Movie MySQL Query

	// get the result from using mysql_query 
	$movie_query = "SELECT title, year FROM Movie WHERE title LIKE '%{$keyword[0]}%'";
	
	for($i = 1; $i < count($keyword); $i++) {	//Handle multi-word searches for movie
		$movie_query .= " AND title LIKE '%{$keyword[$i]}%'";
	}

	//echo $movie_query;	//Testing Purpose

	$result = mysql_query("$movie_query", $db_connection);

	while($row = mysql_fetch_row($result)) {
    	$title = $row[0];
    	$year = $row[1];
    	print "Movie: $title($year)<br />";
	}

	// close the database
	mysql_close($db_connection);
}
?>

</body>
</html>