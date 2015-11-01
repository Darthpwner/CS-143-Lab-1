<html>
	<head>
		<title>Project 1C: Show Actor Information</title>
	</head>
	<body>
		<?php
			$actor_query = "SELECT first, last, dob FROM Actor WHERE (first LIKE '%{$keyword[0]}%' OR last LIKE '%{$keyword[0]}%')";

			$name = "Matthew Lin";	//Concatenate first and last 
			$sex = "Male";
			$dob = "1995-03-26";
			$dod = "NULL";

			echo "$name<br />";
			echo "$sex<br />";
			echo "$dob<br />";
			echo "$dod<br />";

			include 'search.php';
		?>
	</body>
</html>