<?php
    echo "<pre>";

    $parsed = parse_url($_SERVER['REQUEST_URI']);
    $path = $parsed["path"];

    switch ($path) {
        case '/exchanger':

            $value = (int)($_GET['amount'] ?? 1);
            $sourceCurrency = $_GET['from'] ?? 'USD';
            $targetCurrency = $_GET['to'] ?? 'HUF';

            $content = file_get_contents('https://kodbazis.hu/api/exchangerates?base=' . $sourceCurrency);
            $decodedContent = json_decode($content, true);

            // echo "<pre>";
            
            $result = $decodedContent['rates'][$targetCurrency] * $value;

            $currencies = json_decode(file_get_contents('./currencies.json'), true);

            require "./views/converter.php";

            break;
        case '/':

            break;
        default:
            break;
    }