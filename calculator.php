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
   // replace -- with +
   $input = str_replace("--", "+", $input);
 
   $pattern1 = "/[^\d\+\-\*\/\.\ ]/"; //Handles empty string and spaces without digits
   // removing unwanted characters
   if(preg_match($pattern1, $input)) {
       //echo $input;
       echo "Invalid Expression!";
       return;
   }

  $pattern2 = "/(\b0\d)/"; //Handling leading 0s
  // removing leading zeros
  if (preg_match($pattern2, $input)){
       echo "Invalid Expression: leading zero";
       return;
  }

  //$pattern3 = "/\d\ *\/\ *0\^./"; //Handling dividing by 0
  $pattern3 = "/\d\ *\/\ *0/"; //Handling dividing by 0
  // removing dividing by 0
  if (preg_match($pattern3, $input)){
       //echo $input;
       echo "Division by zero error!";
       return;
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
