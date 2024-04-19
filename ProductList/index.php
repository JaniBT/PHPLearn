
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

    function complieTemplate($filePath, $params = []): string
    {
        ob_start();
        require $filePath;
        return ob_get_clean();
    }

    function homeHandler() {
        complieTemplate('.views/wrapper.php');
    }

    function productListHandler() {
        $contents = file_get_contents("./products.json");
        $products = json_decode($contents, true);
        include './views/product-list.php';
        $isSuccess = isset($_GET['siker']);
    }


    
    function createProductHandler() {
        echo '<pre>';
        var_dump($_POST);
        $newProduct = [
            "name" => $_POST["name"],
            "price" => (int)$_POST["price"],
        ];

        $content = file_get_contents("./products.json");
        $products = json_decode($content, true);

        array_push($products, $newProduct);

        $json = json_encode($products);
        file_put_contents("./products.json", $json);

        header("Location: /termekek?siker=true");
    }

    function notFoundHandler() {
        echo "Oldal nem található!";
    }
?>