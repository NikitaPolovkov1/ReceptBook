<?php
// Настройки базы данных
$host = '127.0.0.1';
$port = 8889;        // Порт MySQL
$dbname = 'recipes_db'; // Имя базы данных
$username = 'root';  // Пользователь для сервера
$password = 'root';  // Пароль для сервера

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
