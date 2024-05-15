<?php

$host = 'localhost';
$db   = 'Hackathon';
$user = 'root';
$pass = '';
$charset = 'UTF8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// set the PDO error mode to exception and the default fetch mode to associative arrays
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {
    echo 'Connextion failed' . $e->getMessage();
}
