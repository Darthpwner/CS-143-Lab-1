<html>
<body>

<form action = "calculator.php" method = "get">
<input type='text' name = 'expr'>
<input type = 'submit' value = 'Calculate'>
</form>

<?php

function removeExtraSpaces($input) {
   for($i = 0; $i < strlen($input); $i++) {
       if($input[$i] == ' ' && $input[$i + 1] == ' ') {   //Detect extra spaces
           for($j = $i; $j < strlen($input); $j++) {
	       $input[$j] = $input[$j + 1];  //Move everything back 1 character
   	   }
       }
   }
   return $input;
}

// test
function errorChecker($input) {
    //$pattern = "/[0-9-+/*.]/";   //Regex to detect legal characters
    
     $pattern = "/[\d\+\-\*\/\. ]/";


/*    if(preg_match($pattern, $input) == 0) {
	echo $pattern;
	
        echo $input; //BUG: Not showing up
	
        echo "Invalid Expression";
        return false;
    }*/

   for($i = 0; $i < strlen($input); $i++) {
       if(preg_match($pattern, $input[$i]) == 0) {
	        echo $pattern;
           //echo $input[i];
	        echo "Invalid Expression!";
	        return false;
       }
   }

    //echo "GOOD";
    return;	    
}

function performCalculation($input) {
    //Remove unnecessary spaces
    $cleanedInput = removeExtraSpaces($input);
    echo $input;
    $performOperation = $cleanedInput;
    echo $performOperation;
    
    //Perform error checking
    //if(!errorChecker($performOperation)) {
    //    return;
    //}

    //evaluate
    eval("\$output = $performOperation;");
    echo $output;

    return $cleanedInput + " = " +  $output;
}

$input = $_GET["expr"];
$temp = removeExtraSpaces($input); //good

$x = errorChecker($temp);
$output = performCalculation($x);

//echo $temp;
//echo $x;

echo $output;

?>

</body>
</html>
