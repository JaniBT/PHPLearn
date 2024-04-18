<?php
    // Tömb
    $foods = array("apple", "orange", "banana", "coconut");

    // érték változtatás
    // $foods[0] = "pineapple";
    
    // Tömb végére pakolás
    array_push($foods, "pineapple");

    // utolsó elem törlés
    array_pop($foods);

    // első elem törlése
    array_shift($foods);

    // lista megfordítása
    $reversedFoods = array_reverse($foods);

    // Lista elemek számolása
    echo count($foods);

    // echo $foods[0] . "<br>";
    // echo $foods[1] . "<br>";
    // echo $foods[2] . "<br>";
    // echo $foods[3] . "<br>";

    foreach ($foods as $food) {
        echo "$food <br>";
    }

?>