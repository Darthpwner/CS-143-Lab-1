<html>
<head> <title> Project 1B: Query </title></head>
  
<body>

	<h1> CS143: Project 1B - Query </h1>
	By Kang (Frank) Chen & Matthew Lin <br/>
	Type an SQL query in the following box:

	<p>
		<form action="." method="GET">
		<textarea name="query" cols="60" rows="8">
		</textarea><br />
		<input type="submit" value="Submit" />
		</form>
	</p>

<?php
// get input
if ($_GET["query"]){
	$input = $_GET["query"];

	// cs 143 connection
	$database_connection = mysql_connect("localhost", "cs143", "");
	if (!$database_connection) {
		$error_msg = mysql_err($database_connection);
		print "Connection cannot be established: $error_msg <br />";
		exit(1);
	}

	// obtain the input
	$query = $input;
	mysql_select_db("CS143", "database_connection");

	// display user's query
	echo "Your query: ".$query." <br />";
	echo "<h3> Results from MyAQL: </h3>";

	$result = mysql_query($query, $database_connection);

	// check that the query is valid
	if (!$result){
		die('The query could not be performed <br/>' . mysql_error());
	}

	// get the results and place into table
	$k = 0;
	echo '<table border=1 cellspacing=1 cellpadding=2><tr>';
	while ($k < mysql_num_fields($result)){
		$field = mysql_fetch_field($result, $k);
		echo '<td><b>' . $field->name . '</b></td>';
		$k = $k + 1;
	}
	echo '<tr>';

	// loop through a row of the result
	while ($row = mysql_fetch_row($result)){
		// for each element of the row, we want to display it
		for ($i = 0; $i < $k; $k++){
			if ($row[$i] == NULL){
				echo '<td> N/A </td>';
			}
			else {
				echo '<td>' . $row[$i] . '</td>';
			}
		}
		echo '</td><tr>';
	}
	echo '</tr></table>';

	// close the database, for now we are done
	mysql_close($database_connection);
}
?>


</body>
</html>