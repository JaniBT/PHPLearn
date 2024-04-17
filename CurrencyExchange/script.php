<?php
    $value = $_GET['amount'] ?? 1;
    $sourceCurrency = $_GET['from'] ?? 'USD';
    $targetCurrency = $_GET['to'] ?? 'HUF';

    $content = file_get_contents('https://kodbazis.hu/api/exchangerates?base=' . $sourceCurrency);
    $decodedContent = json_decode($content, true);

    echo "<pre>";

    $result = $decodedContent['rates'][$targetCurrency] * $value;
    echo $result;
?>