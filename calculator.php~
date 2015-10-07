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
 
   $pattern1 = "/[^\d\+\-\*\/\.\ ]/"; 
   // removing unwanted characters
   if(preg_match($pattern1, $input)) {
       //echo $input;
       echo "Invalid Expression!";
       return;
   }

  $pattern2_1 = "/0\./"; //Allows 0. 
  $pattern2 = "/\b0\d/"; //Handling leading 0s
  if (preg_match($pattern2_1, $input)) {
      //Do nothing
  } else if (preg_match($pattern2, $input)){ // removing leading zeros
       echo "Invalid Expression: leading zero";
       return;
  }

  $pattern3 = "/\d\.\d*\./"; //Handling multiple decimal points
  // removing multiple decimal points
  if(preg_match($pattern3, $input)) {
     echo "Invalid Expression: multiple decimal points";
     return;                                                  
  }

  $pattern4_1 = "/\d\ *\/\ *0.?0*[1-9+]/"; //Allows 0/[1-9+] division
  $pattern4 = "/\d\ *\/\ *0/"; //Handling dividing by 0

  if (preg_match($pattern4_1, $input)) {
      //Do nothing
  } else if (preg_match($pattern4, $input)){ // removing dividing by 0
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
