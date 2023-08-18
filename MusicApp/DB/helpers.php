<?php

function prepare($input){

    $input=trim(htmlspecialchars($input));
    $input=stripslashes($input);
    return $input;
}

?>