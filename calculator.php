<html>
<body>

<form action = "calculator.php" method = "get">
<input type='text' name = 'expr'>
<input type = 'submit' value = 'Calculate'>
</form>

<?php

function removeExtraSpaces($input) {
   for($i = 0; $i < strlen($input); $i++) {
       if($input[$i] == ' ' && $input[$i + 1] == ' ') {   //Detected extra spaces
           for($j = $i; $j < strlen($input); $j++) {
	       $input[$j] = $input[$j + 1];  //Move everything back 1 character
   	   }
       }
   }
   return $input;
}

// test
function errorChecker($input) {
    $pattern = "/[0-9-+/*.]/";   //Regex to detect legal characters

//    echo $pattern;

//    if(preg_match($pattern, $input) == 0) {
//        echo "Invalid Expression";
//        return false;
//    }

    for($i = 0; $i < strlen($input); $i++) {
        if(preg_match($pattern, $input[$i]) == 0) {
	   echo "Invalid Expression!";
	   return false;
	}
    }

    echo "GOOD";
    return true;	    
}

function performCalculation($input) {
    //Remove unnecessary spaces
    $cleanedInput = removeExtraSpaces($input);

    $performOperation = $cleanedInput;

    //Perform error checking
    if(!errorChecker($performOperation)) {
        return;
    }
    return $performOperation;

    //Perform multiplication & division
    for($i = 0; $i < strlen($performOperation); $i++) {
        //TODO
    }

    //Perform addition & subtraction
    for($i = 0; $i < strlen($performOperation); $i++) {
        //TODO
    }

    return $cleanedInput + " = " +  $performOperation;
}

$expr = $_GET["expr"];
$temp = removeExtraSpaces($expr);

$x = errorChecker($temp);

//echo $temp;
echo $x;

?>

</body>
</html>
