<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книга Рецептов</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <div class="container">
        <div class="auth-controls">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Привет, <?= $_SESSION['username']; ?>!</span>
                <form id="search-form">
                    <input type="text" id="search" name="search" placeholder="Поиск рецептов...">
                </form>
                <div class="btn-cont">
                    <a href="index.php">Главная</a>
                    <a href="account.php">Мой аккаунт</a>
                    <a href="logout.php">Выйти</a>
                </div>
            <?php else: ?>
                <a href="index.php">Главная</a>
                <form id="search-form">
                    <input type="text" id="search" name="search" placeholder="Поиск рецептов...">
                </form>
                <div class="btn-cont">
                    <a href="login.php">Авторизация</a>
                    <a href="register.php">Регистрация</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

