<html>
	<head>
		<title>Project 1C: Add Actor/Director</title>
	</head>

	<body>
		<h1> CS 143: Project 1C - Add Actor/Director</h1>
		By Kang (Frank) Chen & Matthew Lin <br/>

		Add new actor/director:
		<br></br>
		<form action="./addActorDirector.php" method="GET">
			Identity: 
			<input type="radio" checked="true" value="Actor" name="identity"></input>
			Actor 
			<input type="radio" value="Director" name="identity"></input>
			Director
			<br></br>
			<hr></hr>
			First name:
			<input type="text" maxlength="20" name="first"></input>
			<br></br>
			Last name: 
			<input type="text" maxlength="20" name="last"></input>
			<br></br>
			Sex:
			<input type="radio" checked="true" value="Male" name="sex"></input>
			Male
			<input type="radio" value="Female" name="sex"></input>
			Female
			<br></br>
			Date of Birth:
			<input type="radio" value="Female" name="sex"></input>
			Date of Death:
			<input type="text" name="dod"></input>
			(leave blank if alive now)
			<br></br>
			<input type = "submit"
		</form>
	</body>
</html>