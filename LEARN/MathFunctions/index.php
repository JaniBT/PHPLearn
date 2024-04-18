<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="index.php" method="post">
        <label for="">x:</label>
        <input type="text" name="x">
        <label for="">y:</label>
        <input type="text" name="y">
        <input type="submit" value="Total">
    </form> -->

    <form action="index.php" method="post">
        <label for="">Sugár:</label>
        <input type="text" name="radius">
        <input type="submit" value="Számolás">
    </form>
</body>
</html>

<?php
    // $x = $_POST["x"];
    // $y = $_POST["y"];
    // $total = null;

    // $total = abs($x); -- Abszolút érték
    // $total = round($x); -- Kerekítés
    // $total = floor($x); -- Lefele kerekítés
    // $total = ceil($x); -- Felfele kerekítés
    // $total = pow($x, $y);
    // $total = sqrt($x); -- Négyzetgyök
    // $total = max($x, $y, $z); -- Legnagyobb szám
    // $total = min($x, $y, $z); -- Legkisebb szám

    // $total = pi(); -- PI = 3.14
    
    // $total = rand(); -- Random szám generátor, használható két számmal. Pl.: rand(15, 100);

    $radius = $_POST["radius"];
    $circumference = null;
    $area = null;
    $volume = null;

    $circumference = 2 * pi() * $radius;
    $circumference = round($circumference, 2);

    $area = pi() * pow($radius, 2);
    $area = round($area, 2);

    $volume = 4/3 * pi() * pow($radius, 3);
    $volume = round($volume, 2);

    echo "A Kör kerülete = {$circumference}cm <br>";
    echo "A kör területe = {$area}cm^2 <br>";
    echo "A gömb térfogata = {$volume}cm^3 <br>";
?>