<html>
<body>

<?php

function removeExtraSpaces($input) {
   for($i = 0; $i < strlen($input); $i++) {
       if($input[$i] == ' ' && $input[$i + 1]) {   //Detected extra spaces
           for($j = $i; $j < strlen($input); $j++) {
	       $input[$i] = $input[$i + 1];  //Move everything back 1 character
	       }       
   	   }
   }
}

function errorChecker($input) {
    $pattern = '[0-9-+/*.]';   //Regex to detect legal characters
    
    for($i = 0; $i < strlen($input); $i++) {
        if(!preg_match($pattern, $input[$i])) {
	   echo "Invalid Expression!";
	   return false;
	}
    }
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
//echo "$expr";
echo $_GET["expr"];

?>

<form action = "calculator.php" method = "get">
<input type='text' name = 'expr'>
<input type = 'submit' value = 'Calculate'>
</form>

<?php

$expr = $_GET["expr"];
echo $expr;

?>

</body>
</html>