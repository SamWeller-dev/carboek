<?php

$host = "localhost";
$dbname =  "carboek";
$username = "bit_academy";
$password = "bit_academy";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $query = $pdo->query('select version()')->fetchColumn();
} catch (PDOException $e) {
    echo $e->getMessage();
}
