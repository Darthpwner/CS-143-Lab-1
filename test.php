<?php
// The "i" after the pattern delimiter indicates a case-insensitive search

   $pattern = "/php/i";
   echo $pattern;
if (preg_match($pattern, "PHP is the web scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}
?>