<html>
	<head>
		<title>Project 1C: Show Actor Information</title>
	</head>
	<body>
		<?php
			if ($_GET["id"]) {
				$input = $_GET["id"]; // id of actor

				// establish a connection
				$db = mysql_connect("localhost", "cs143", "");
				if(!$db) {
					$errmsg = mysql_error($db);
					print "Connection failed: $errmsg <br />";
					exit(1);
				}
				mysql_select_db("CS143", $db);

				// query for information about the actor
				$query = "SELECT first, last, dob, dod, sex 
				          FROM Actor WHERE id = '$input'";


			}
		?>
	</body>
</html>