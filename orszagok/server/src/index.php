<?php
$method = $_SERVER['REQUEST_METHOD'];
$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

$routes = [
    'GET' => [
        "/" => "countryListHandler",
        "/view-country" => "singleCountryHandler",
        "/view-city" => "singleCityHandler",
        "/page-not-found" => "notFoundHandler",
    ],
    'POST' => [
        "/register" => "registrationHandler",
        "/login" => "loginHandler"
    ],
];

$handleFunction = $routes[$method][$path] ?? 'notFoundHandler';

$handleFunction();

function loginHandler()
{
    $pdo = getConntection();
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $statement->execute([$_POST['email']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "invalidCredentials";
        return;
    }
    
    $isVerified = password_verify($_POST["password"], $user["password"]);
    if (!$isVerified) {
        echo 'invalid Credentials';
        return;
    }

    session_start();
    $_SESSION['userId'] = $user["id"];

    header("Location: /");
}

function registrationHandler()
{
    $pdo = getConntection();
    $statement = $pdo->prepare(
        'INSERT INTO `users` (`email`, `password`, `createdAt`) 
                VALUES (?, ?, ?)'
    );
    $statement->execute([
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        time()
    ]);

    header('Location: /');
}

function isLoggedIn() {
    if (!isset($_COOKIE[session_name()])) {
        return false;
    }
    session_start();

    if (!isset($_SESSION['userId'])) {
        return false;
    }

    return true;
}

function singleCountryHandler()
{
    if (!isLoggedIn()) {
        echo compileTemplate('wrapper.phtml', [
            'content' => compileTemplate('subscriptionForm.phtml')
        ]);

        return;
    }

    $countryId = $_GET['id'] ?? '';
    $pdo = getConntection();

    $statement = $pdo->prepare('SELECT * FROM countries WHERE id = ?');
    $statement->execute([$countryId]);
    $country = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare('SELECT * FROM cities WHERE countryId = ?');
    $statement->execute([$countryId]);
    $cities = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare(
        'SELECT * FROM countryLanguages 
                            JOIN languages ON languageId = languages.id 
                            WHERE countryId = ?'
    );
    $statement->execute([$countryId]);
    $languages = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$country) {
        header('Location: /page-not-found');
    }

    echo compileTemplate('wrapper.phtml', [
        'content' => compileTemplate('countrySingle.phtml', [
            'country' => $country,
            'cities' => $cities,
            'languages' => $languages,
        ])
    ]);
};

function singleCityHandler()
{
    $cityId = $_GET['id'] ?? '';
    $pdo = getConntection();

    $statement = $pdo->prepare('SELECT * FROM cities WHERE id = ?');
    $statement->execute([$cityId]);
    $city = $statement->fetch(PDO::FETCH_ASSOC);

    echo compileTemplate('wrapper.phtml', [
        'content' => compileTemplate('citySingle.phtml', [
            'city' => $city,
        ])
    ]);
}

function countryListHandler()
{
    $pdo = getConntection();

    $statement = $pdo->prepare('SELECT * FROM countries');
    $statement->execute();
    $countries = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo compileTemplate('wrapper.phtml', [
        'content' => compileTemplate('countryList.phtml', [
            'countries' => $countries
        ])
    ]);
};

function getConntection()
{
    return new PDO(
        'mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'],
        $_SERVER['DB_USER'],
        $_SERVER['DB_PASSWORD']
    );
};

function compileTemplate($filePath, $params = []): string
{
    ob_start();
    include __DIR__ . "/views/" . $filePath;
    return ob_get_clean();
}

function notFoundHandler()
{
    echo "page not found";
}
