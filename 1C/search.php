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
		
	//$keyword = $input;
	mysql_select_db("CS143", $db_connection);

	// display user's keyword search
	echo "You are searching: [";
	for($i = 0; $i < count($keyword); $i++) {
		echo "$keyword[$i]";
		if($i < count($keyword) - 1) {	//Handles multi-word searches
			echo " ";
		}
	}
	echo "] results...<br /><br />";
	
	//Actor MySQL Query
	getResult(Actor);

	echo "<br />";

	// get the result from using mysql_query 
	$actor_query = "SELECT first, last FROM Actor WHERE (first LIKE '%{$keyword[0]}%' OR last LIKE '%{$keyword[0]}%')";
	
	for($i = 1; $i < count($keyword); $i++) {	//Handles multi-word searches for actor
		$actor_query .= " AND (first LIKE '%{$keyword[$i]}%' OR last LIKE '%{$keyword[$i]}%')";
	}																	  

	echo $actor_query;	//Testing Purpose

	$result = mysql_query($actor_query, $db_connection);

	// check that the query is valid
	if (!$result){
		$error_msg = mysql_error();
		print "The query could not be performed: $error_msg <br/>";
		exit(1);
	}

	// get the results and place into tables to be displayed later
	$k = 1;	//Start at 1 to get first valid tuple
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
			}
			else {
				echo '<td>' . $row[$i] . '</td>';
			}
		}
		echo '</td><tr>';
	}
	// close tr and table tag
	echo '</tr></table>';

	getResult(Movie);

	//Movie MySQL Query

	// get the result from using mysql_query 
	$movie_query = "SELECT title FROM Movie WHERE title LIKE '%{$keyword[0]}%'";
	
	for($i = 1; $i < count($keyword); $i++) {	//Handle multi-word searches for movie
		$movie_query .= " AND title LIKE '%{$keyword[$i]}%'";
	}

	echo $movie_query;	//Testing Purpose

	$result = mysql_query("$movie_query", $db_connection);

	// check that the query is valid
	if (!$result){
		$error_msg = mysql_error();
		print "The query could not be performed: $error_msg <br/>";
		exit(1);
	}

	// get the results and place into tables to be displayed later
	$k = 1;	//Start at 1 to get first valid tuple
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
			}
			else {
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