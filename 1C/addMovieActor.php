<html>
	<head>
		<title>Project 1C: Add Movie/Actor relationship</title>
	</head>

	<body>
		<h1>CS 143: Project 1C - Add Movie/Actor Relation</h1>
		Add new actor in a movie:
		<br></br>
		<form action="./addAMovieActor.php" method="GET>
			Movie: 
			<select name="mid"></select>
			<br></br>
			Actor: 
			<select name="aid"></select>
			<br></br>
			Role: 
			<input type="text" name="role" maxlength="50">
			<br></br>
			<input type="submit" value="Add it!">
		</form>
		<hr>
	</body>
</html>