<?php
require '../config/db.php';

$search_query = $_GET['search'] ?? '';

try {
    if ($search_query) {
        $query = $pdo->prepare("
            SELECT recipes.id, recipes.name, recipes.ingredients, recipes.instructions, recipes.image, users.username AS author 
            FROM recipes 
            JOIN users ON recipes.user_id = users.id
            WHERE recipes.name LIKE :search OR recipes.ingredients LIKE :search
        ");
        $query->execute(['search' => '%' . $search_query . '%']);
    } else {
        $query = $pdo->query("
            SELECT recipes.id, recipes.name, recipes.ingredients, recipes.instructions, recipes.image, users.username AS author 
            FROM recipes 
            JOIN users ON recipes.user_id = users.id
        ");
    }

    $recipes = $query->fetchAll();

    if (!empty($recipes)) {
        foreach ($recipes as $recipe) {
            echo "<div class='recipe'>
                    <img src='../uploads/" . htmlspecialchars($recipe['image'] ?? '') . "' alt=''>
                    <h2>" . htmlspecialchars($recipe['name'] ?? '') . "</h2>
                    <p><strong>Автор:</strong> " . htmlspecialchars($recipe['author'] ?? 'Неизвестно') . "</p>
                    <a href='recipe.php?id=" . $recipe['id'] . "'>Подробнее</a>
                  </div>";
        }
    } else {
        echo "<p>Рецептов не найдено.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Ошибка: " . $e->getMessage() . "</p>";
}
?>
