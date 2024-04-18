<?php
    // $age = 101;

    // Nem mindegy milyen sorban van az if

    // if ($age >= 100) {
    //     echo "Túl öreg vagy haver.";
    // }
    // elseif ($age >= 18) {
    //     echo "Felnőtt vagy.";
    // }
    // elseif ($age <= 0) {
    //     echo "Nem valid kor.";
    // }
    // else {
    //     echo "Nem vagy felnőtt még.";
    // }

    // $adult = false;

    // if ($adult) {
    //     echo "Szia!";
    // } else {
    //     echo "Szia kisgyerek";
    // }

    $hours = 50;
    $rate = 15;
    $weekly_pay = null;

    if ($hours <= 0) {
        $weekly_pay = 0;
    }
    elseif ($hours <= 40) {
        $weekly_pay = $hours * $rate;
    } else {
        $weekly_pay = ($rate * 40) + (($hours - 40) * ($rate * 1.5));
    }

    echo "You made \${$weekly_pay} this week.";
?>