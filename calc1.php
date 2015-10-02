<html>
<head> <title> Calculator </title></head>
  
<body>

<h1> Calculator </h1>
By Kang (Frank) Chen & Matthew Lin <br/>
Type an expression in the following box (e.g., 10.5+20*3/25).


<p>
<form method = "GET">
<input type = "text" name = "expr" />
<input type = "submit" value = "Calculate" />
</form>
</p>

<?php

function errorChecker($input) {
   $pattern = "/[^\d\+\-\*\/\.\ ]/"; //Handles empty string and spaces without digits

   // replace -- with +
   $input = str_replace("--", "+", $input);

   if(preg_match($pattern, $input)) {
       echo $input;
       echo "Invalid Expression";
   }
   eval("\$output = $input;");
   return $output;
}

$input = $_GET["expr"];
$original = $input;
//
$output = errorChecker($input);
//

if (is_numeric($output))
   echo "".$original." = ".$output."<br/>";
//else
  // echo "Invalid input expression! <br/>";

?>

</body>
</html>
