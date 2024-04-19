<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); // Mindig az adott fájl kapja az adatot. Azért kell a htmlspecialchars() függvény, hogy ne lehessen malicious script-eket beágyazni ?>" method="post">
        username: <br>
        <input type="text" name="username">
        <input type="submit" value="Login">
    </form>
</body>
</html>
<?php
    foreach($_SERVER as $key => $value) {
        echo "$key = $value <br>";
    }

    // jobb mint az isset($_POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Hello";
    }
?>