<?php

require __DIR__ . '\\src\\handlers.php';

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routes = [
    '/' => 'homeHandler',
    '/counties' => 'countiesHandler'
];

if (array_key_exists($uri, $routes)) {
    call_user_func($routes[$uri]);
} else {
    http_response_code(404);
    echo "404 Not found!";
}