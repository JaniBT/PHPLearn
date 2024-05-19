<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?);";
        $statement = $pdo->prepare($query);
        $statement->execute([$username, $password, $email]);
        
        $pdo = null;
        $statement = null;

        die();
    } catch(PDOException $e) {
        die("Query failed: {$e->getMessage()}");
    }
} else {
    header('Location: ../index.php');
}