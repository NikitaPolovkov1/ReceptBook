<?php
require '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: account.php');
            exit;
        } else {
            $error = "Неверный email или пароль!";
        }
    } catch (PDOException $e) {
        die("Ошибка: " . $e->getMessage());
    }
}

include '../templates/header.php';
?>
<h1>Вход</h1>
<form method="POST" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Войти</button>
</form>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<?php
include '../templates/footer.php';
?>
