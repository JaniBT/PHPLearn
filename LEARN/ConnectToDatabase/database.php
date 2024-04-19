<?php 

    $db_server = "127.0.0.1";
    $db_user = "root";
    $db_pass = "Passw123";
    $db_name = "products";

    $conn = "";

    try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        if ($conn) {
            echo "You are connected <br>";
        }
    }
    catch (mysqli_sql_exception $error) {
        echo "Couldn't connect <br>";
    }
?>