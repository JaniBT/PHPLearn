<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php 
    $password = "Pizza123";

    // Jelszó hashing algoritmus, át alakítja a jelszót és azzal az értékkel megy tovább

    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Ellenőrzi, hogy a beírt jelszó és az elmentett hash-elt jelszó matematikailag egyeznek e, és ha igen akkor be enged

    if (password_verify("Pizza123", $hash)) {
        echo "You are logged in";
    } else {
        echo "Incorrect password";
    }
?>