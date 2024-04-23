<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href=".././public/style.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-danger">
        <div class="navbar-nav">
            <a href="/" class="nav-item nav-link <?= $params['activeLink'] === "/" ? "active" : ""?>">
                Címlap
            </a>
            <a href="/termekek" class="nav-item nav-link <?= $params['activeLink'] === "/termekek" ? "active" : ""?>">
                Termékek
            </a>
        </div>
    </nav>
    <?= $params['innerTemplate'] ;?>
    <footer class="bg-danger text-center fixed-bottom text-lg-start">
        <div class="text-center p-3">
            Footer Tartalom
        </div>
    </footer>
</body>
</html>