<html>
	<head>
		<title>Project 1C: Add New Movie</title>
	</head>
	<body>
		<h1> CS 143: Project 1C - Add New Movie</h1>
		By Kang (Frank) Chen & Matthew Lin <br/>

        Add New Movies:
		<form action="./AddMovieInfo.php" method="GET">
		Title: <input type "text" name = "title" maxlength = "20"><br/>
		Company: <input type = "text" name = "company" maxlength = "50"><br/>
		Year: <input type = "text" name = "year" maxlength = "4"><br/>
		MPAA Rating: 
		<select name = "mpaarating">
			<option value = "G">G</option>
			<option value = "NC-17">NC-17</option>
			<option value = "PG">PG</option>
			<option value = "PG-13">PG-13</option>
			<option value = "R">R</option>
		</select>
		<br/>
		Genre:
		<input type = "checkbox" name = "genre_Action" value = "Action"> Action </input>
		<input type = "checkbox" name = "genre_Adult" value = "Action"> Adult </input>
		<input type = "checkbox" name = "genre_Adventure" value = "Action"> Adventure </input>
		<input type = "checkbox" name = "genre_Animation" value = "Action"> Animation </input>
		<input type = "checkbox" name = "genre_Comedy" value = "Action"> Comedy </input>
		<input type = "checkbox" name = "genre_Crime" value = "Action"> Crime </input>
		<input type = "checkbox" name = "genre_Documentary" value = "Action"> Documentary </input>
		<input type = "checkbox" name = "genre_Drama" value = "Action"> Drama </input>
		<input type = "checkbox" name = "genre_Family" value = "Action"> Family </input>
		<input type = "checkbox" name = "genre_Fantasy" value = "Action"> Fantasy </input>
		<input type = "checkbox" name = "genre_Horror" value = "Action"> Horror </input>
		<input type = "checkbox" name = "genre_Musical" value = "Action"> Musical </input>
		<input type = "checkbox" name = "genre_Mystery" value = "Action"> Mystery </input>
		<input type = "checkbox" name = "genre_Romance" value = "Action"> Romance </input>
		<input type = "checkbox" name = "genre_Sci-Fi" value = "Action"> Sci-Fi </input>
		<input type = "checkbox" name = "genre_Short" value = "Action"> Short </input>
		<input type = "checkbox" name = "genre_Thriller" value = "Action"> Thriller </input>
		<input type = "checkbox" name = "genre_War" value = "Action"> War </input>
		<input type = "checkbox" name = "genre_Western" value = "Action"> Western </input>
		<br/>
		<input type = "submit" value = "Add it!"/>

		</form>
	</body>
</html>
