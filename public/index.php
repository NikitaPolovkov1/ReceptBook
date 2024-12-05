<?php

require '../config/db.php';
try {
    $query = $pdo->query("SELECT recipes.id, recipes.name, recipes.ingredients, recipes.instructions, recipes.image, users.username AS author 
                          FROM recipes 
                          JOIN users ON recipes.user_id = users.id");
    $recipes = $query->fetchAll();
} catch (PDOException $e) {
    die("Ошибка получения данных: " . $e->getMessage());
}

include '../templates/header.php';
?>
<h1>Книга Рецептов</h1>
<hr>
<div id="recipes-container" class="container-main">

    <?php if ($recipes): ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe">
                <img src="../uploads/<?= $recipe['image']?>" alt="">
                <h2><?= $recipe['name'] ?></h2>
                <p><strong>Автор:</strong> <?= $recipe['author'] ?></p>
                <a href="recipe.php?id=<?= $recipe['id'] ?>">Подробнее</a>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Рецептов нет.</p>
    <?php endif; ?>
</div>

<?php
    include '../templates/footer.php';
?>

