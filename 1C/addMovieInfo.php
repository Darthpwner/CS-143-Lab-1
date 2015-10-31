<html>
	<head>
		<title>Project 1C: Add New Movie</title>
	</head>
	<body>
		<h1> CS 143: Project 1C - Add Movie</h1>
		By Kang (Frank) Chen & Matthew Lin <br/>

		Add new movie:
		<br></br>
		<form method="post">
		<input type = "hidden" name = "click" />
		<p>Title: <input type "text" maxlength = "100" name = "title" 
			<?php 
				if (!$_GET["did"]) 
					echo "disabled = \"disabled\""; 
			?> /><br/></p>
		<p>Company: <input type "text" maxlength = "50" name = "company"
			<?php 
				if (!$_GET["did"])
					echo "disabled = \"disabled\"";
			?> /><br/></p>
		<p>Year: <input type "text" name = "year"
			<?php 
				if (!$_GET["did"])
					echo "disabled = \"disabled\"";
			?> /> (between 1900 and 2015) <br/></p>
		</form>
	</body>
</html>
