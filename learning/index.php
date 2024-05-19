<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <h3>Signup</h3>

    <main>
        <form action="includes/formhandler.inc.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username">
            <label for="username">Password</label>
            <input type="password" name="password" id="password" placeholder="Password">
            <label for="username">Username</label>
            <input type="email" name="email" id="email" placeholder="E-mail">
            <button>Signup</button>
        </form>
    </main>
</body>
</html>