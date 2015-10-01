function removeSpaces($input) {
   for($i = 0; $i < strlen($input); $i++) {
       if($input[$i] == ' ') {	    //If you detect a space
           for($j = $i; $j < strlen($input); $j++) {
	       $input[$i] = $input[$i + 1];  //Move everything back 1 character
	   }
       }
   }
}

function errorChecker($input) {
    $pattern = '[0-9-+/*.]';   //Regex to detect legal characters
    

    for($i = 0; $i < strlen($input); $i++) {

    }
}