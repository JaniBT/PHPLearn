<?php

require './router.php';
require './slugifier.php';

$method = $_SERVER["REQUEST_METHOD"];
$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

// Útvonalak regisztrálása
$routes = [
    // [method, útvonal, handlerFunction],
    ['GET', '/', 'homeHandler'],
    ['GET', '/admin/etel-szerkesztese/{keresoBaratNev}', 'dishEditHandler'],
    ['GET', '/admin', 'adminDashboardHandler'],
    ['POST', '/login', 'loginHandler'],
    ['POST', '/update-dish/{dishId}', 'updateDishHandler'],
    ['GET', '/admin/uj-etel-letrehozasa', 'dishCreatePageHandler'],
    ['POST', '/create-dish', 'createDishHandler'],
    ['POST', '/delete-dish/{dishId}', 'deleteDishHandler'],
    ['GET', '/admin/etel-tipusok', 'adminDishTypeHandler'],
    ['POST', '/create-dish-type', 'createDishTypeHandler'],
    ['POST', '/logout', 'logoutHandler']
];

// Útvonalválasztó inicializálása
$dispatch = registerRoutes($routes);
$matchedRoute = $dispatch($method, $path);
$handlerFunction = $matchedRoute['handler'];
$handlerFunction($matchedRoute['vars']);

function logoutHandler() {
    session_start();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_destroy();
    
    header('Location: /');
}

function createDishTypeHandler() {
    redirectToLoginIfNotSignedIn();
    $pdo = getConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO dishTypes (name, slug, description) VALUES (?, ?, ?)'
    );

    $stmt->execute([
        $_POST['name'],
        slugify($_POST['name']),
        $_POST['description']
    ]);

    header('Location: /admin/etel-tipusok');
}

function adminDishTypeHandler() {
    redirectToLoginIfNotSignedIn();

    $pdo = getConnection();
    $dishTypes = getAllDishTypes($pdo);

    echo render("admin-wrapper.phtml", [
        'content' => render('dish-type-list.phtml', [
            'dishTypes' => $dishTypes
        ])
    ]);
}

function deleteDishHandler($urlParams) {
    redirectToLoginIfNotSignedIn();

    $pdo = getConnection();
    $stmt = $pdo->prepare('DELETE FROM dishes WHERE id = ?');
    $stmt->execute([$urlParams['dishId']]);

    header('Location: /admin');
}

function dishCreatePageHandler() {
    redirectToLoginIfNotSignedIn();

    $pdo = getConnection();
    $dishTypes = getAllDishTypes($pdo);

    echo render('admin-wrapper.phtml', [
        'content' => render('create-dish.phtml', [
            'dishTypes' => $dishTypes
        ])
    ]);
}

function createDishHandler() {
    $pdo = getConnection();
    $stmt = $pdo->prepare(
        "INSERT INTO dishes (name, slug, description, price, isActive, dishTypeId) VALUES (:nev, :slug, :leiras, :ar, :aktiv, :dishTypeId)"
    );

    $stmt->execute([
        "nev" => $_POST["name"],
        "slug" => slugify($_POST["name"]),
        "leiras" => $_POST["description"],
        "ar" => $_POST["price"],
        "aktiv" => (int)isset($_POST["isActive"]),
        "dishTypeId" => $_POST["dishTypeId"]
    ]);

    header("Location: /admin");
}

function loginHandler() {
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if (!$user) {
        header('Location: /admin?info=invalidCredentials');
        return;
    }

    if (!password_verify($_POST['password'], $user['password'])) {
        header('Location: /admin?info=invalidCredentials');
        return;
    }

    session_start();
    $_SESSION['userId'] = $user['id'];
    header('Location: /admin');
}

function isLoggedIn() {
    if (!isset($_COOKIE[session_name()])) {
        return false;
    }

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['userId'])) {
        return false;
    }

    return true;
}

function adminDashboardHandler() {
    if (!isLoggedIn()) {
        echo render("wrapper.phtml", [
            'content' => render('login.phtml')
        ]);
        return;
    }

    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM dishes ORDER BY id DESC");
    $stmt->execute();
    $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo render('admin-wrapper.phtml', [
        'content' => render('dish-list.phtml', [
            'dishes' => $dishes
        ])
    ]);
}

// Handler függvények deklarálása
function homeHandler()
{
    $pdo = getConnection();
    $dishTypes = getAllDishTypes($pdo);

    foreach($dishTypes as $index => $dishType) {
        $stmt = $pdo->prepare("SELECT * FROM dishes WHERE isActive = 1 AND dishTypeId = ?");
        $stmt->execute([$dishType['id']]);
        $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dishTypes[$index]['dishes'] = $dishes;
    }

    echo render("wrapper.phtml", [
        'content' => render("public-menu.phtml", [
            'dishTypesWithDishes' => $dishTypes
        ])
    ]);
}

function dishEditHandler($vars)
{
    redirectToLoginIfNotSignedIn();
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM dishes WHERE slug = ?');
    $stmt->execute([$vars['keresoBaratNev']]);
    $dish = $stmt->fetch(PDO::FETCH_ASSOC);

    $dishTypes = getAllDishTypes($pdo);

    echo render("admin-wrapper.phtml", [
        'content' => render("edit-dish.phtml", [
            'dish' => $dish,
            'dishTypes' => $dishTypes
        ])
    ]);
}

function getAllDishTypes($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM dishTypes');
    $stmt->execute();
    $dishTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dishTypes;
}

function redirectToLoginIfNotSignedIn() {
    if (isLoggedIn()) {
        return;
    }

    header('Location: /admin');
    exit;
}

function updateDishHandler($urlParams) {
    redirectToLoginIfNotSignedIn();

    $pdo = getConnection();
    $stmt = $pdo->prepare('UPDATE dishes SET name = ?, slug = ?, description = ?, price = ?, dishTypeId = ?, isActive = ? WHERE id = ?');
    $stmt->execute([
        $_POST['name'], $_POST['slug'], $_POST['description'], $_POST['price'], $_POST['dishTypeId'], (int)isset($_POST['isActive']), $urlParams['dishId']
    ]);
    
    header('Location: /admin');
}

function notFoundHandler()
{
    http_response_code(404);
    echo render("wrapper.phtml", [
        'content' => '404.phtml'
    ]);
}

function render($path, $params = [])
{
    ob_start();
    require __DIR__ . '/views/' . $path;
    return ob_get_clean();
}

function getConnection()
{
    return new PDO(
        'mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'],
        $_SERVER['DB_USER'],
        $_SERVER['DB_PASSWORD']
    );
}
