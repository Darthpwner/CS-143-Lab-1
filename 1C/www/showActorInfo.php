<html>
	<head>
		<title>Project 1C: Show Actor Information</title>
	</head>
	<body>
		<?php
			include 'search.php';

			$input = $_GET["aid"];   // WHAT VALUE DO I have?
			echo "$input<br />";

			$actor_query = "SELECT first, last, dob FROM Actor WHERE id=$input";

			

			// for($i = 0; $i < 10; $i++) {
			// 	echo $actor_query[$i];
			// }
			
			//Assign variables
			// $row = mysql_fetch_row($actor_query)
   //  		$name = ".$row[0]." ".$row[1].";
   //  		$sex = $row[2];
   //  		$dob = $row[3];
   //  		$dod = $row[4];

   //  		echo "Name: $name<br />";
   //  		echo "Sex: $sex<br />";
   //  		echo "Date of Birth: $dob<br />";

   //  		echo "Date of Death: ";
   //  		//Print variables
			// if($dod != "") {
			// 	echo "$row[4]";
			// } else {
			// 	echo "Still Alive<br />";
			// }

			// echo "$name<br />";
			// echo "$sex<br />";
			// echo "$dob<br />";
			// echo "$dod<br />";

			include 'search.php';
		?>
	</body>
</html>