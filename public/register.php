<?php
session_start();
require '../config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "Все поля обязательны для заполнения.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Пароли не совпадают.";
    }

    if (empty($errors)) {
        $query = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        if ($query->fetch()) {
            $errors[] = "Этот Email уже зарегистрирован.";
        }
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = $pdo->prepare("
            INSERT INTO users (username, email, password_hash, created_at) 
            VALUES (:username, :email, :password_hash, :created_at)
        ");

        $insert_query->execute([
            'username' => $username,
            'email' => $email,
            'password_hash' => $hashed_password,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['username'] = $username;

        header('Location: account.php');
        exit;
    }
}
include "../templates/header.php";
?>


<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li style="color: red;"><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<h1>Регистрация</h1>
<form action="register.php" method="POST">
    <label for="username">Имя:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Повторите пароль:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <button type="submit">Зарегистрироваться</button>
</form>
<?php

include "../templates/footer.php";
