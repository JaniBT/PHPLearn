<?php 

require __DIR__ . '\\dbs.inc.php';

function homeHandler() {
    global $pdo;
    // querying database
    $statement = $pdo->query('SELECT * FROM megyek');
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    include __DIR__ . '/../views/home.phtml';
}

function countiesHandler() {

}