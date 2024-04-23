
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
            "/termekek" => "createProductHandler",
            "/delete-product" => 'deleteProductHandler',
            "/edit-product" => 'editProductHandler'
        ]
    ];

    $handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

    $safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : "notFoundHandler";

    $safeHandlerFunction();

    function compileTemplate($filePath, $params = []): string
    {
        ob_start();
        require $filePath;
        return ob_get_clean();
    }

    function homeHandler() {
        $homeTemplate = compileTemplate("./views/home.php");

        echo compileTemplate("./views/wrapper.php", [
            'innerTemplate' => $homeTemplate,
            'activeLink' => '/',
        ]);
    }

    function productListHandler() {
        
        $contents = file_get_contents("./products.json");
        $products = json_decode($contents, true);
        $isSuccess = isset($_GET['siker']);
        
        $productListTemplate = compileTemplate("./views/product-list.php", [
            'products' => $products,
            'isSuccess' => $isSuccess,
            'editedProductId' => $_GET['szerkesztes'] ?? ''
        ]);

        echo compileTemplate("./views/wrapper.php", [
            'innerTemplate' => $productListTemplate,
            'activeLink' => '/termekek'
        ]);
    }

    function editProductHandler() {
        $editedProductId = $_GET['id'];
        $editedName = $_POST['editedName'];
        $editedPrice = $_POST['editedPrice'];

        $content = file_get_contents("./products.json");
        $products = json_decode($content, true);
        $foundProductIndex = -1;

        foreach ($products as $index => $product) {
            if ($product['id'] === $editedProductId) {
                $foundProductIndex = $index;
            }
        }

        if ($foundProductIndex === -1) {
            return;
        }

        array_splice($products, $foundProductIndex, 1, [(object)["id" => "$editedProductId", "name" => "$editedName", "price" => "$editedPrice"]]);

        file_put_contents("./products.json", json_encode($products));

        header("Location: /termekek");
    }

    
    function createProductHandler() {
        echo '<pre>';
        var_dump($_POST);
        $newProduct = [
            "id" => uniqid(),
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

    function deleteProductHandler() {
        $deletedProductId = $_GET['id'];
        $products = json_decode(file_get_contents('products.json'), true);
        $foundProductId = -1;

        foreach ($products as $index => $product) {
            if ($product['id'] === $deletedProductId) {
                $foundProductId = $index;
                break;
            }
        }

        if ($foundProductId === -1) {
            return;
        }

        array_splice($products, $foundProductId, 1);

        $json = json_encode($products);
        file_put_contents("./products.json", $json);

        header("Location: /termekek");

        // echo '<pre>';
        // var_dump($products);
    }
?>