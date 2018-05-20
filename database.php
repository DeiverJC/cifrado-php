<?php

$server = 'localhost';
$username = 'root';
$password = '';
$dbName = 'php-login';

try {
    $connection = new PDO("mysql:host=$server;dbname=$dbName;", $username, $password);
} catch (PDOException $e) {
    die('Connected failed: '. $e->getMessage());
}