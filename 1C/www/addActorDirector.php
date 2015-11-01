<html>
	<head>
		<title>Project 1C: Add Actor/Director</title>
	</head>

	<body>
		<h1> CS 143: Project 1C - Add Actor/Director</h1>
		By Kang (Frank) Chen & Matthew Lin <br/>

		Add new actor/director:
		<br></br>
		<form method="post">
		<p><b>First: </b><input type="text" name="first" maxlength="20"/><br/></p>
		<p><b>Last: </b><input type="text" name="last" maxlength="20" /><br/></p>
		<p><b>Gender: </b><input type="radio" name="sex" value="Male" checked/> Male 
		                  <input type="radio" name="sex" value="Female"/> Female</p>

		<p><b>Actor or Director: </b>
		<input type="checkbox" name="actorCheckBox"/> Actor
		<input type="checkbox" name="directorCheckBox"/> Director </p>

		<p><b> Date of Birth: </b>
		<select name="dobmonth"> <option value = "0"></option>
		<?php 
		 	$month = array( '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
		 					'05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', 
		 					'09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
			// add each month to the option list
			foreach ($month as $k => $m) 
				echo "<option value=\"$k\">$m</option>"; 
		 ?>
		</select>

		<select name="dobday"> <option value = "0"></option>
		<?php 
		    for ($x=01;$x<32;$x++) 
				echo "<option value=\"$x\">$x</option>"; 
		?>
	    </select>
	    <select name="dobyear"> <option value = "0"></option>
		<?php 
			for ($x=2012;$x>1900;$x--) 
				echo "<option value=\"$x\">$x</option>"; 
		?>
		</select>
		(Month - Day - Year) 
		</p>

		<p><b>Date of Death (if Applicable): </b>
		<select name="dodmonth"><option value="0"></option>
		<?php 	// for each month, add to the option list
			foreach ($month as $k => $m) 
				echo "<option value=\"$k\">$m</option>";	
		?>
	 	</select>
		<select name="dodday"><option value="0"></option>
		<?php 
			for ($x=01;$x<32;$x++) 	
				echo "<option value=\"$x\">$x</option>"; 
		?>
	 	</select>
		<select name="dodyear"><option value="0"></option>
		<?php 
			for ($x=2012;$x>1900;$x--) 
				echo "<option value=\"$x\">$x</option>"; 
		?>
	 	</select>
		(Month - Day - Year) 
		</p>

		<p><input type="submit" value="Add Person" name="clicked"/></p>
		</form>
		</p>

		<?php
		/* Add Actor or Director into the database */
		if ($_POST["first"] && $_POST["last"] && $_POST["dobyear"] && 
			$_POST["dobmonth"] && $_POST["dobday"] && 
			(isset($_POST["actorCheckBox"]) || isset($_POST["directorCheckBox"]))) {

			$tfirst = $_POST["first"]; 								// first name
			$tlast = $_POST["last"];								// last name
			$sex = $_POST["sex"];									// gender
			$actor_flag = isset($_POST["actorCheckBox"]);			// actor flag
			$director_flag = isset($_POST["directorCheckBox"]);		// director flag

			$dobday = $_POST["dobday"];
			$dobmonth = $_POST["dobmonth"];
			$dobyear = $_POST["dobyear"]; 
			$dob = "$dobyear-$dobmonth-$dobday"; 	

			$dodday = $_POST["dodday"];
			$dodmonth = $_POST["dodmonth"];
			$dodyear = $_POST["dodyear"]; 
			$dod = "$dodyear-$dodmonth-$dodday"; 
			$dod_flag = 0;

			$success = 0;

			$addActor = "";
			$addDirector = "";

			if ($doddday > 0 && $dodmonth > 0 && $dodyear > 0) {
				$dod_flag = 1; // we want to add the dod, since it was inputted
			}

			if (str_replace(" ", "", $tfirst) == ""){
				echo "ENTER A FIRST NAME";
			} elseif (str_replace(" ", "", $tlast) == "") {
				echo "ENTER A LAST NAME";
			} elseif (($dodyear > 0 && ($dodmonth == 0 || $dodday == 0)) ||
				      ($dodmonth > 0 && ($dodday == 0 || $dodyear == 0)) ||
				      ($dodday > 0 && ($dodyear == 0 || $dodmonth == 0))) {
				echo "ENTER A VALID DEATH DATE";
			} elseif ($dodyear != 0 && $dodmonth != 0 && $dodday != 0 && (strtotime($dob) > strtotime($dod))) {
				echo "ENTER A VALID DEATH DATE";
			} elseif (($dodyear%4 != 0 && $dodmonth == 2 && $dodday > 28) || 
				      ($dodyear%4 == 0 && $dodmonth == 2 && $dodday > 29)) {
				echo "$dodmonth - $dodday - $dodyear IS NOT VALID!";
			} elseif (($dodmonth==4 || $dodmonth==6 || $dodmonth==9 || $dodmonth==11) && $dodday > 30) {
				echo "$dodmonth - $dodday - $dodyear IS NOT VALID!";
			} else {
				// create db connection
				$db = mysql_connect("localhost", "cs143", "");
				if(!$db) {
					$errmsg = mysql_error($db);
					print "Connection SHIT failed: $errmsg <br />";
					exit(1);
				}					
				mysql_select_db("TEST", $db);

				$firstname = mysql_real_escape_string($tfirst);
				$lastname = mysql_real_escape_string($tlast);

				$pidquery = "SELECT id FROM MaxPersonID";
				$pidsearch = mysql_query($pidquery, $db);
				$pidfinished = mysql_fetch_row($pidsearch);
				$pid = $pidfinished[0];

				// add info to Actor Table
				if ($dod_flag == 0){
					$addActor = "INSERT INTO Actor VALUES ($pid, '$lastname', '$firstname', '$sex', '$dob', NULL)";
					echo $addActor;
				}
				else {
					$addActor = "INSERT INTO Actor VALUES ($pid, '$lastname', '$firstname', '$sex', '$dob', '$dod')";
				}

				// add info to Director Table
				if ($dod_flag == 0)
					$addDirector = "INSERT INTO Director VALUES ($pid, '$lastname', '$firstname', '$sex', '$dob', NULL)";
				else
					$addDirector = "INSERT INTO Director VALUES ($pid, '$lastname', '$firstname', '$sex', '$dob', '$dod')";

				echo "<p>";
				if ($actor_flag) {
					if (mysql_query($addActor, $db)){
						echo "SUCCESSFULLY ADDED $tfirst $tlast AS AN ACTOR. ";
						// echo "View your profile <a href='./actors.php?id=$pid'>here</a><br/>";
						$success = 1;
					} else { echo "ADDING ACTOR UNSUCCESSFUL."; }
				}
				if ($director_flag) {
					if (mysql_query($addDirector, $db)){
						echo "SUCCESSFULLY ADDED $tfirst $tlast AS AN DIRECTOR. ";
						// echo "View your profile <a href='./actors.php?id=$pid'>here</a><br/>";
						$success = 1;
					} else { echo "ADDING DIRECTOR UNSUCCESSFUL."; }
				}
				if ($success == 1) {
					mysql_query("UPDATE MaxPersonID SET id=id+1", $db);
					echo "entered";
				}
				echo "</p>";
				mysql_close($db);
			}
		} // checks to see if you click the submit but dont have the required input for actor or director
	 	elseif ($_POST["clicked"] && (!$_POST["first"] || !$_POST["last"] || 
			  	$_POST["dobyear"]=="0" || $_POST["dobmonth"]=="0" || $_POST["dobday"]=="0" || 
				(!isset($_POST["actorCheckBox"]) && !isset($_POST["directorCheckBox"])))){
		
			// output errors
			echo "<b>";
			if (!$_POST["first"])
				echo "PLEASE ENTER FIRST NAME.A <br/>";
			if (!$_POST["last"])
				echo "PLEASE ENTER LAST NAME. <br/>";
			if (!isset($_POST["actorCheckBox"][0]) && !isset($_POST["actorCheckBox"][1]))
				echo "PLEASE CHOOSE WHETHER YOU WANT ACTOR OR DIRECTOR. <br/>";
			if ($_POST["dobyear"]=="0" || $_POST["dobmonth"]=="0" || $_POST["dobday"]=="0")
				echo "PLEASE ENTER VALID BIRTHDAY <br/>";
			echo "</b>";
		}
		?>
	</body>
</html>