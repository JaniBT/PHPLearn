
<?php
    $method = $_SERVER["REQUEST_METHOD"];
    $parsed = parse_url($_SERVER["REQUEST_URI"]);
    $path = $parsed['path'];

    $routes = [
        "GET" => [
            "/" => "homeHandler",
            "/termekek" => "ProductListHandler"
        ],
        "POST" => [
            "/termekek" => "createProductHandler"
        ]
    ];

    $handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

    $safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : "notFoundHandler";

    $safeHandlerFunction();

    function homeHandler() {
        echo "Címlap!";
    }

    function productListHandler() {
        echo "Termék lista!";
    }

    function createProductHandler() {
        echo "Termék készítés!";
    }

    function notFoundHandler() {
        echo "Oldal nem található!";
    }
?>