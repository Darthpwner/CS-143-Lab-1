<html>
<body>

<form method = "GET">
<input type = "text" name = "expr" />
<input type = "submit" value = "Calculate" />
</form>

<?php

$input = $_GET["expr"];
eval("\$output = $input;");

if (is_numeric($output))
   echo "".$input." = ".$output."<br/>";
else
   echo "Invalid input expression! ".$input."<br/>";


?>

</body>
</html>
