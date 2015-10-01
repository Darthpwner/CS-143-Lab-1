<html>
<body>

<form method = "GET">
<input type = "text" name = "expr" />
<input type = "submit" value = "Calculate" />
</form>

<?php

function errorChecker($input) {
   $pattern = "/(^$)|(\d+)/"; //Handles empty string, any digit, and any space

   if(preg_match($pattern, $input) == 0) {
       echo $input;
       echo "Invalid Expression";
       return false;
   }

   return;
}

$input = $_GET["expr"];

//
$x = errorChecker($input);
echo $x;
//

eval("\$output = $input;");

if (is_numeric($output))
   echo "".$input." = ".$output."<br/>";
//else
//   echo "Invalid input expression! ".$input."<br/>";


?>

</body>
</html>
