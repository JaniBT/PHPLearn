<?php
    // $temp = -20;
    // $cloudy = true;

    // if ($temp < 0 || $temp > 30) {
    //     echo "The weather is terrible <br>";
    // } else {
    //     echo "The weather is good <br>";
    // }

    // if ($cloudy) {
    //     echo "It's cloudy";
    // } else {
    //     echo "It's sunny";
    // }

    $age = 21;
    $citizen = true;

    if (!$age >= 18 || !$citizen) {
        echo "You cannot vote!";
    } else {
        echo "You can vote!";
    }
?>