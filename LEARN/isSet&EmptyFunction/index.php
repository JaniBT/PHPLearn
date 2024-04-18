<?php
    // isset() function returns true if it's not null or have been declared.
    // $username = "JaniBT";

    // if (isset($username)) {
    //     echo "This variable is set.";
    // } else {
    //     echo "This vairable is not set";
    // }

    // empty() function returns true if the variable has a value or is not declared, (returns false if the variable is a blank string or if it's set to false (boolean) or it's null)

    $username = "asdsa";

    if (empty($username)) {
        echo "The variable is empty";
    } else {
        echo "The variable is not empty";
    }
?>