<?php
require '../config/db.php';
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
try {
    $query = $pdo->prepare("SELECT * FROM recipes WHERE user_id = :user_id");
    $query->execute(['user_id' => $user_id]);
    $recipes = $query->fetchAll();
} catch (PDOException $e) {
    die("Ошибка получения данных: " . $e->getMessage());
}
include "../templates/header.php"
?>
<div class="container">
    <h1>Ваши Рецепты</h1>
    <a href="add_recipe.php">Добавить рецепт</a>
    <hr>
    <?php if ($recipes): ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe">
                <img src="../uploads/<?= $recipe['image']?>" alt="">
                <h2><?= $recipe['name'] ?></h2>
                <p><strong>Ингредиенты:</strong> <?= $recipe['ingredients'] ?></p>
                <p><strong>Способ приготовления:</strong> <?= $recipe['instructions'] ?></p>
                <a href="edit_recipe.php?recipe_id=<?= $recipe['id']; ?>">Изменить</a>
                <a href="delete_recipe.php?recipe_id=<?= $recipe['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить этот рецепт?');">Удалить</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Рецептов нет.</p>
    <?php endif; ?>
</div>
<?php
include "../templates/footer.php"
?>

