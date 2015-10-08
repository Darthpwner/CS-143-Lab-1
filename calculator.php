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
 
  
    $pattern0 = "/[^\d\+\-\*\/\.\ ]/"; 
   // removing unwanted characters
   if(preg_match($pattern0, $input)) {
       //echo $input;
       echo "Invalid Expression!";
       return;
   }

  $pattern70_1 = "/^\ *[\+\-\*\/]\ *$/"; //Prevent single operators
  if(preg_match($pattern70_1, $input)) {
      echo "Invalid Expression: Single operator";
      return;
  }

  $pattern71 = "/[\+\-\*\/]\ *[\+\*\/]/"; //Handles strange combinations of operators
  if(preg_match($pattern71, $input)) {
      echo "Invalid Expression: Strange combinations of operators";
      return;
  }

//BUG
  $pattern69 = "/-\ *-\ *-/"; //Handles more than 3 minus signs
  if (preg_match($pattern69, $input)) {
     echo "Invalid Expression: more than 3 minus signs";
     return;
  }

   $pattern1 = "/^\ *[\+\*\/]\ *\d/";
   if(preg_match($pattern1, $input)) {
       echo "Invalid Expression: Handling operator at beginning";
       return;
   }

   $pattern2 = "/\d\ *[\+\-\*\/]\ *$/"; //Handles hanging operators at the end
   if (preg_match($pattern2, $input)) {
       echo "Invalid Expression: hanging operator at end";
       return;
   }

   $pattern3 = "/[\+\*\/]\ *[\+\*\/]/"; //Handles multiple operators without operands
  if (preg_match($pattern3, $input)) {
      echo "Invalid Expression: multiple operators without operands";
      return;
  }

  $pattern4_1 = "/0\./"; //Allows 0. 
  $pattern4 = "/\b0\d/"; //Handling leading 0s
  if (preg_match($pattern4_1, $input)) {
      //Do nothing
  } else if (preg_match($pattern4, $input)){ // removing leading zeros
       echo "Invalid Expression: leading zero";
       return;
  }

  $pattern5 = "/\d\.\d*\./"; //Handling multiple decimal points
  // removing multiple decimal points
  if(preg_match($pattern5, $input)) {
     echo "Invalid Expression: multiple decimal points";
     return;                                                  
  }

  $pattern6_1 = "/\d\ *\/\ *0.?0*[1-9+]/"; //Allows 0/[1-9+] division
  $pattern6 = "/\d\ *\/\ *0/"; //Handling dividing by 0

  if (preg_match($pattern6_1, $input)) {
      //Do nothing
  } else if (preg_match($pattern6, $input)){ // removing dividing by 0
       //echo $input;
       echo "Division by zero error!";
       return;
  }

   eval("\$output = $input;");
   return $output;
}

$input = $_GET["expr"];
$original = $input;
$output = errorChecker($input);

if (is_numeric($output))
   echo "".$original." = ".$output."<br/>";
?>

</body>
</html>
