<?php
    $value = $_GET['amount'] ?? 1;
    $sourceCurrency = $_GET['from'] ?? 'USD';
    $targetCurrency = $_GET['to'] ?? 'HUF';

    $content = file_get_contents('https://kodbazis.hu/api/exchangerates?base=' . $sourceCurrency);
    $decodedContent = json_decode($content, true);

    // echo "<pre>";
    
    $result = $decodedContent['rates'][$targetCurrency] * $value;

    $currencies = json_decode(file_get_contents('./currencies.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <div class="card w-25 m-auto p-3">
        <form action="/" method="GET">
            <input class="form-control mb-2" type="number" name="amount" value="<?= $value ?>">
        </form>
    </div>
    
</body>
</html>