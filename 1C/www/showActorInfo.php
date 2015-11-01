<html>
	<head>
		<title>Project 1C: Show Actor Information</title>
	</head>
	<body>
		<?php
			function printVariables($name, $sex, $dob, $dod) {
				echo "Name: $name<br />";
    			echo "Sex: $sex<br />";
    			echo "Date of Birth: $dob<br />";

    			echo "Date of Death: ";
    			//Print variables
				if($dod != "") {
					echo "$row[4]";
				} else {
					echo "Still Alive<br />";
				}
			}

			include 'search.php';

			//establish connection with the MySQL database
			$db_connection = mysql_connect("localhost", "cs143", "");
		
			//choose database to use
			mysql_select_db("CS143", $db_connection);

			$input = $_GET["aid"];   // WHAT VALUE DO I have?
			echo "$input<br />";

			$actor_query = "SELECT first, last, sex, dob FROM Actor WHERE id=$input";

			$result = mysql_query($actor_query, $db_connection);

			//Assign variables
			$row = mysql_fetch_row($result);
    		$name .= "$row[0] $row[1]";
    		$sex = $row[2];
    		$dob = $row[3];
    		$dod = $row[4];

    		//Print variables
    		printVariables($name, $sex, $dob, $dod);
		?>
	</body>
</html>