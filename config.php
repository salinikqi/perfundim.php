<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "test";

try {
    $connect = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Something went wrong: " . htmlspecialchars($e->getMessage()));
}
?>