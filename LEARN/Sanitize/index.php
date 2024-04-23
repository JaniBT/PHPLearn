<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        username: <br>
        <input type="text" name="username"> <br>
        age: <br>
        <input type="text" name="age"> <br>
        email: <br>
        <input type="text" name="email"> <br>
        <input type="submit" name="login" value="login">
    </form>
</body>
</html>
<?php
    if (isset($_POST["login"])) {

        // SANITIZE:

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS); // -- Filtereli a speciális karaktereket, hogy ne lehessen malicious kódot elküldeni a szerver felé. Lásd: MySQL script pl.
        // Side Notes: ``
        // Példa: filter_input(`Ha GET a method: INPUT_GET, ha POST, akkor: INPUT_POST`, `A name tulajdonsága az input mezőnek`, `És hogy mi alapján akarja filterelni. Lásd: NUMBER_INT for Integers, SPECIAL_CHARS for strings.`)

        $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        echo "You are $age years old, and your name is: $username! Your email address is: $email";

        // VALIDATE:

        // $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT); // validátor, ha rendes int-et kap akkor azt adja vissza, ha nem, ez esetben egy üres string-et.

        // $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

        // if (empty($email)) { // Megnézi, hogy üres string e az $age változó
        //     echo "That email wasn't valid";
        // } else {
        //     echo "Your email is: $email";
        // }
        
    }
?>