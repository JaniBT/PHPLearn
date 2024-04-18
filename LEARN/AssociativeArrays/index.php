<?php
    // asszociatív tömb (Szótár javascript-ben)

    $capitals = array("USA"=>"Washington D.C.",
                    "Japan"=>"Tokyo",
                    "South Korea"=>"Seoul",
                    "India"=>"New Delhi");
    // echo $capitals["Japan"];

    // update a value
    // $capitals["USA"] = "Las Vegas";

    // új kulcs érték pár
    $capitals["China"] = "Beijing";

    // loop through each key value pair
    foreach ($capitals as $key => $value) {
        echo "$key - $value <br>";
    }
?>