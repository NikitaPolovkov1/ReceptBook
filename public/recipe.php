<?php
require '../config/db.php';
session_start();
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Рецепт не найден.');
}
$recipe_id = $_GET['id'];

try {
    $query = $pdo->prepare("
        SELECT r.*, u.username 
        FROM recipes r 
        JOIN users u ON r.user_id = u.id 
        WHERE r.id = :id
    ");
    $query->execute(['id' => $recipe_id]);
    $recipe = $query->fetch();

    if (!$recipe) {
        die('Рецепт не найден.');
    }
} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}
include '../templates/header.php';
?>


<h1><?= htmlspecialchars($recipe['name']) ?></h1>

<div class="container">
    <img src="<?= $recipe['image']?>" alt="">
    <p><strong>Автор:</strong> <?= htmlspecialchars($recipe['username']) ?></p>
    <p><strong>Ингредиенты:</strong></p>
    <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

    <p><strong>Инструкции:</strong></p>
    <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>

    <?php if (!empty($recipe['image_path'])): ?>
        <img src="../uploads/<?= htmlspecialchars($recipe['image_path']) ?>" alt="<?= htmlspecialchars($recipe['title']) ?>" style="max-width: 100%; height: auto;">
    <?php endif; ?>

    <a href="index.php">Вернуться на главную</a>
</div>

<?php include '../templates/footer.php'; ?>
