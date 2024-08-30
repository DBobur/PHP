<?php
$host = 'localhost';
$port = '5432';
$dbname = 'todo_db';  // Ma'lumotlar bazasi nomi
$username = 'postgres'; // PostgreSQL foydalanuvchi nomi
$password = '1483'; // PostgreSQL paroli

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


